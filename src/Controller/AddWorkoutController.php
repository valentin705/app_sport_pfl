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

        // Récupère l'utilisateur connecté
        $user = $this->getUser();

        $form = $this->createForm(SeanceType::class, $seance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On ajoute l'utilisateur connecté à la séance
            $seance->setUser($user);

            $manager->persist($seance);

            $manager->flush();

            return $this->redirectToRoute('add_workout', ['id' => $seance->getId()]);
        }

        return $this->render('main/add_workout.html.twig', [
            'formSeance' => $form->createView(),
            'editMode' => $seance->getId() !== null
        ]);
    }

}