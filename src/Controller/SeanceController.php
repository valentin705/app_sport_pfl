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
use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;

class SeanceController extends AbstractController
{
    #[Route('/seance/ajouter', name: 'ajout_seance')]
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

            return $this->redirectToRoute('ajout_seance');
        }

        return $this->render('seance/ajouter.html.twig', [
            'formSeance' => $form->createView(),
            'editMode' => $seance->getId() !== null
        ]);
    }

    #[Route('/seance/liste', name: 'liste_seances')]
    public function listeSeances(SeanceRepository $seanceRepository): Response
    {
        $seances = $seanceRepository->findBy([], ['id' => 'DESC']);

        return $this->render('seance/liste.html.twig', [
            'seances' => $seances
        ]);
    }

    #[Route('/seance/{id}', name: 'show_seance')]
    public function afficherSeance(
        Seance $seance,
        Request $request,
        EntityManagerInterface $manager
    ) {

        $comment = new Comment();
        $comment->setSeance($seance);

        $user = $this->getUser();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($user);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('show_seance', ['id' => $seance->getId()]);
        }

        return $this->render('seance/show_seance.html.twig', [
            'seance' => $seance,
            'formComment' => $form->createView()
        ]);
    }

}
