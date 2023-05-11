<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Seance;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Form\ExerciceType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class UpdateExerciceController extends AbstractController
{
    #[Route('main/update_exercise/{id}', name: 'update_exercice')]
    public function updateExercice(
        Exercice $exercice,
        EntityManagerInterface $manager,
        Request $request,
        SluggerInterface $slugger,
        Seance $seance = null
    )
    {

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

            return $this->redirectToRoute('update_workout', ['id' => $exercice->getSeance()->getId()]);
        }

        return $this->render('main/update_exercise.html.twig', [
            'formExercice' => $form->createView(),
            'editMode' => $exercice->getId() !== null,
            'exercice' => $exercice,
        ]);
    }

}
