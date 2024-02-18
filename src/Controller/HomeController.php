<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SeanceRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    // Méthode dédiée pour l'API qui renvoie une réponse JSON
    #[Route('/api/home', name: 'api_home_list')]
    public function apiListeSeances(
        SeanceRepository $seanceRepository,
        CategoryRepository $categoryRepository,
    ): JsonResponse {
        $categories = $categoryRepository->findAll();
        $seances = $seanceRepository->findSeancesOrderedByDesc();

        // Transformer les séances en tableau
        $seancesData = array_map(function ($seance) {
            return [
                'id' => $seance->getId(),
                'name' => $seance->getName(),
                'description' => $seance->getDescription(),
                // Ajoutez d'autres champs que vous souhaitez exposer
            ];
        }, $seances);

        // De même pour les catégories si nécessaire
        $categoriesData = array_map(function ($category) {
            return [
                // Structure pour les catégories
            ];
        }, $categories);

        // Préparer les données pour la réponse JSON
        $data = [
            'seances' => $seancesData,
            // Ajoutez 'seancesByLikes' et 'categories' si nécessaire
        ];

        // Retourne une réponse JSON
        return new JsonResponse($data);
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
