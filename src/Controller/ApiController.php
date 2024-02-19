<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SeanceRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api')]
class ApiController extends AbstractController
{

// Méthode dédiée pour l'API qui renvoie une réponse JSON
    #[Route('/home', name: 'api_home_list')]
    public function apiListeSeances(
        SeanceRepository $seanceRepository,
        CategoryRepository $categoryRepository,
        Request $request // Injectez le service Request pour accéder aux infos de la requête
    ): JsonResponse {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $seances = $seanceRepository->findSeancesOrderedByDesc();

        $baseUrl = $request->getSchemeAndHttpHost();

        // if ($user) {
        //     $userImageUrl = $baseUrl . '/uploads/avatar/' . $user->getPictureFile();
        //     $userData = [
        //         'id' => $user->getId(),
        //         'username' => $user->getUsername(),
        //         'image' => $userImageUrl,
        //     ];
        // } else {
        //     $userData = null;
        // }

        // Définissez $userData avec des valeurs par défaut ou null si $user n'est pas défini
        $userData = [
            'id' => $user ? $user->getId() : null,
            'username' => $user ? $user->getUsername() : 'Invité',
            'image' => $user ? $baseUrl . '/uploads/avatar/' . $user->getPictureFile() : null,
        ];

        // Obtention et transformation des catégories
        $categories = $categoryRepository->findAll();
        $categoriesData = array_map(function ($category) {
            return [
                'id' => $category->getId(),
                'name' => $category->getName(),
            ];
        }, $categories);

        // Transformation des séances
        $seancesData = array_map(function ($seance) use ($baseUrl) {
            $imagePath = $seance->getPictureFile(); // Assurez-vous que PictureFile contient le nom de l'image de la séance
            $imageUrl = $baseUrl . '/uploads/picturesSeances/' . $imagePath; // Construction de l'URL de l'image

            return [
                'id' => $seance->getId(),
                'name' => $seance->getName(),
                'description' => $seance->getDescription(),
                'imageUrl' => $imageUrl, // URL de l'image de la séance
                'likes' => count($seance->getLikes()),
            ];
        }, $seances);

        // Construction de la réponse JSON
        $data = [
            'user' => $userData,
            'categories' => $categoriesData,
            'seances' => $seancesData,
        ];

        return new JsonResponse($data);
    }

    #[Route('/user', name: 'api_user')]
    public function getUserDetails(): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        // Supposons que getPublicData() est une méthode dans votre entité User qui renvoie les données que vous voulez exposer
        $userData = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'description' => $user->getDescription(),
            'image' => $user->getPictureFile(),
        ];

        return $this->json(['user' => $userData]);
    }

} 

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Component\Routing\Annotation\Route;
// use App\Service\SeanceService;
// use App\Service\CategoryService;
// use App\Service\UserService;
// use Symfony\Component\HttpFoundation\Request;

// #[Route('/api')]
// class ApiController extends AbstractController
// {
//     private SeanceService $seanceService;
//     private CategoryService $categoryService;
//     private UserService $userService;

//     public function __construct(SeanceService $seanceService, CategoryService $categoryService, UserService $userService)
//     {
//         $this->seanceService = $seanceService;
//         $this->categoryService = $categoryService;
//         $this->userService = $userService;
//     }

//     #[Route('/home', name: 'api_home_list')]
//     public function apiListeSeances(Request $request): JsonResponse
//     {
//         $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//         $baseUrl = $request->getSchemeAndHttpHost();

//         return new JsonResponse([
//             'user' => $this->userService->getUserDataForApi($this->getUser(), $baseUrl),
//             'categories' => $this->categoryService->getCategoryDataForApi(),
//             'seances' => $this->seanceService->getSeanceDataForApi($baseUrl),
//         ]);
//     }

//     #[Route('/user', name: 'api_user')]
//     public function getUserDetails(): JsonResponse
//     {
//         $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//         $user = $this->getUser();

//         if (!$user) {
//             return $this->json(['error' => 'Utilisateur non trouvé'], JsonResponse::HTTP_UNAUTHORIZED);
//         }

//         return $this->json(['user' => $this->userService->getUserPublicData($user)]);
//     }
// }