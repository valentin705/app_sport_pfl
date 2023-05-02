<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Seance;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    ) {
        // Verification user avant action
        if ($this->VerifyUser($seance)) {
            return;
        }

        $form = $this->createForm(SeanceExercicesType::class, $seance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($seance);

            $manager->flush();

            // return $this->redirectToRoute('show_workout', ['id' => $seance->getId()]);

            if ($request->request->get('route') === 'ajouter') {
                // Logique pour la route 'ajouter'
                return $this->redirectToRoute('add_exercise', ['id' => $seance->getId()]);
            } elseif ($request->request->get('route') === 'modifier') {
                // Logique pour la route 'finir'
                return $this->redirectToRoute('show_workout', ['id' => $seance->getId()]);
            }
        }

        return $this->render('main/update_workout.html.twig', [
            'formSeance' => $form->createView(),
            'editMode' => $seance->getId() !== null,
            'seance' => $seance,
        ]);
    }

    #[Route('/main/update_workout/{id}/delete', name: 'delete_workout')]
    public function deleteWorkout(
        Seance $seance,
        EntityManagerInterface $manager
    ) {
        // Verification user avant action
        if ($this->VerifyUser($seance)) {
            return;
        }

        $manager->remove($seance);
        $manager->flush();

        return $this->redirectToRoute('home_list');
    }

    #[Route('/main/update_workout/{id}/delete_exercise/{exercice}', name: 'delete_exercise')]
    public function deleteExercise(
        Seance $seance,
        Exercice $exercice,
        EntityManagerInterface $manager,
    ) {
        // Verification user avant action
        if ($this->VerifyUser($seance)) {
            return;
        }

        // $seance->removeExercice($exercice);
        $manager->remove($exercice);
        $manager->persist($seance);
        $manager->flush();

        return $this->redirectToRoute('update_workout', ['id' => $seance->getId()]);
    }

    public function VerifyUser($seance)
    {
        $user = $this->getUser();
        if ($user != $seance->getUser()) {
            return $this->redirectToRoute('home_list')->send();
        }
    }
}
