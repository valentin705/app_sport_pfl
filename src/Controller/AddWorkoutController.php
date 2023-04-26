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

class AddWorkoutController extends AbstractController
{
    #[Route(path: '/main/add_workout', name: 'add_workout')]
    public function ajouterSeance(
        Request $request,
        EntityManagerInterface $manager,
        Seance $seance = null
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