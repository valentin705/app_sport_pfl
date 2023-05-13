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
use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AddExerciseController extends AbstractController
{
    #[Route('/main/add_exercise/{id}', name: 'add_exercise')]
    public function ajouterExercice(
        Seance $seance,
        Request $request,
        EntityManagerInterface $manager,
        SluggerInterface $slugger
    ) {
        $exercice = new Exercice();
        $exercice->setSeance($seance);
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pictureFile = $form->get('pictureFile')->getData();
            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $pictureFile->guessExtension();
                try {
                    $pictureFile->move(
                        $this->getParameter('exercice_avatar_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $exercice->setPictureFile($newFilename);
            }
            $manager->persist($exercice);
            $manager->flush();
            return $this->redirectToRoute(
                'add_exercise',
                ['id' => $seance->getId()]
            );
        }
        return $this->render('main/add_exercise.html.twig', [
            'exercice' => $exercice,
            'formExercice' => $form->createView(),
            'seance' => $seance,
        ]);
    }
}
