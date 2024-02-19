<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SeanceRepository;
use App\Repository\CategoryRepository;

class HomeController extends AbstractController
{
    // Méthode pour le rendu de la vue Twig
    #[Route('/main/home', name: 'home_list')]
    public function listeSeances(
        SeanceRepository $seanceRepository,
        CategoryRepository $categoryRepository,
    ): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $categories = $categoryRepository->findAll();
        $seances = $seanceRepository->findSeancesOrderedByDesc();
        $seancesByLikes = $seanceRepository->createdOrderByLikesQueryBuilder();

        return $this->render('main/home.html.twig', [
            'seances' => $seances,
            'seancesByLikes' => $seancesByLikes,
            'categories' => $categories,
            'user' => $user
        ]);
    }


    #[Route('/main/home/{slug}', name: 'home_list_by_category')]
    public function listeSeancesByCategory(
        string $slug,
        SeanceRepository $seanceRepository,
        CategoryRepository $categoryRepository,
    ): Response {
        $categories = $categoryRepository->findAll();
        $seances = $seanceRepository->findByCategory($slug);
        $seancesByLikes = $seanceRepository->createdOrderByLikesQueryBuilder();

        return $this->render('main/home.html.twig', [
            'seances' => $seances,
            'seancesByLikes' => $seancesByLikes,
            'categories' => $categories,
        ]);
    }
}
