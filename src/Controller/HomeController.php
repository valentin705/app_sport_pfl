<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SeanceRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
        Request $request // Injectez le service Request pour accéder aux infos de la requête
    ): JsonResponse {
        $seances = $seanceRepository->findSeancesOrderedByDesc();

        $seancesData = array_map(function ($seance) use ($request) {
            // Construisez l'URL de base.
            $baseUrl = $request->getSchemeAndHttpHost();

            $imagePath = $seance->getPictureFile(); // Accès au champ de l'entité
            // Chemin du dossier où les images sont stockées, ajustez si votre structure de dossiers change
            $imageUrl = $baseUrl . '/uploads/picturesSeances/' . $imagePath;

            return [
                'id' => $seance->getId(),
                'name' => $seance->getName(),
                'description' => $seance->getDescription(),
                'imageUrl' => $imageUrl, // Utilisez 'imageUrl' comme clé dans la réponse JSON
                'likes' => count($seance->getLikes()),
                // autres champs...
            ];
        }, $seances);

        $data = [
            'seances' => $seancesData,
            // Ajoutez 'seancesByLikes' et 'categories' si nécessaire
        ];

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
