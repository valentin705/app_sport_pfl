<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Seance;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Comment;
use App\Form\CommentType;
// use App\Service\SlugGenerator;

class ShowWorkoutController extends AbstractController
{
    #[Route('main/show_workout/{id}', name: 'show_workout')]
    public function afficherSeance(
        Seance $seance,
        Request $request,
        EntityManagerInterface $manager,
        // SlugGenerator $slugGenerator,
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

            return $this->redirectToRoute('show_workout', ['id' => $seance->getId()]);
        }
        // $slug = $slugGenerator->generateUniqueSlug($seance->getName());
        // $seance->setSlug($slug);
        return $this->render('main/show_workout.html.twig', [
            'seance' => $seance,
            'formComment' => $form->createView()
        ]);
    }
}