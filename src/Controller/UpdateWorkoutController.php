<?php

namespace App\Controller;

use App\Entity\Seance;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Form\SeanceType;
use App\Form\SeanceExercicesType;

class UpdateWorkoutController extends AbstractController
{
    #[Route('/main/update_workout/{id}', name: 'update_workout')]
    public function updateWorkout(
        Seance $seance,
        EntityManagerInterface $manager,
        Request $request
    )
    {
        $form = $this->createForm(SeanceExercicesType::class, $seance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($seance);

            $manager->flush();

            return $this->redirectToRoute('show_workout', ['id' => $seance->getId()]);
        }

        return $this->render('main/update_workout.html.twig', [
            'formSeance' => $form->createView(),
            'editMode' => $seance->getId() !== null,
            'seance' => $seance,
        ]);
    }
}
