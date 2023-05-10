<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Seance;
use App\Form\SeanceType;
use App\Repository\SeanceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\SeanceExercicesType;
use App\Entity\Exercice;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AddWorkoutController extends AbstractController
{
    #[Route(path: '/main/add_workout', name: 'add_workout')]
    public function ajouterSeance(
        Request $request,
        EntityManagerInterface $manager,
        Seance $seance = null,
        SluggerInterface $slugger
    ) {
        if (!$seance) {
            $seance = new Seance();
        }

        $exercice = new Exercice();

        $seance->addExercice($exercice);
    
        // Récupère l'utilisateur connecté
        $user = $this->getUser();

        $form = $this->createForm(SeanceExercicesType::class, $seance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On ajoute l'utilisateur connecté à la séance
            $seance->setUser($user);

            $pictureFile = $form->get('pictureFile')->getData();
            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $pictureFile->guessExtension();
                try {
                    // $pictureFile->move(
                    //     $this->getParameter('seance_avatar_directory'),
                    //     $newFilename
                    // );
                    $pictureType = $form->get('pictureType')->getData();
                    if ($pictureType === 'seance') {
                        $directory = $this->getParameter('seance_avatar_directory');
                    } elseif ($pictureType === 'exercice') {
                        $directory = $this->getParameter('exercice_avatar_directory');
                    }
                    // $directory = $pictureType === 'seance' ? $this->getParameter('seance_avatar_directory') : $this->getParameter('exercice_avatar_directory');
                    $pictureFile->move($directory, $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                // $seance->setPictureFile($newFilename); 
                if ($pictureType === 'seance') {
                    $seance->setPictureFile($newFilename);
                } elseif ($pictureType === 'exercice') {
                    $exercice->setPictureFile($newFilename);
                }
            }

            $manager->persist($seance);
            $manager->flush();

            // return $this->redirectToRoute('add_workout', ['id' => $seance->getId()]);

            if ($request->request->get('route') === 'ajouter') {
                // Logique pour la route 'ajouter'
                return $this->redirectToRoute('add_exercise', ['id' => $seance->getId()]);
            } elseif ($request->request->get('route') === 'finir') {
                // Logique pour la route 'finir'
                return $this->redirectToRoute('show_workout', ['id' => $seance->getId()]);
            }
    
        }

        return $this->render('main/add_workout.html.twig', [
            'formSeance' => $form->createView(),
            'editMode' => $seance->getId() !== null,
            'seance' => $seance,
        ]);
    }

}