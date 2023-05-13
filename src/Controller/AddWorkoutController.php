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
        $user = $this->getUser();
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $seance->setUser($user);
            $pictureFile = $form->get('pictureFile')->getData();
            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $pictureFile->guessExtension();
                try {
                    $pictureFile->move(
                        $this->getParameter('seance_avatar_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $seance->setPictureFile($newFilename);
            }
            $manager->persist($seance);
            $manager->flush();
            if ($request->request->get('route') === 'ajouter') {
                return $this->redirectToRoute('add_exercise', ['id' => $seance->getId()]);
            } elseif ($request->request->get('route') === 'finir') {
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
