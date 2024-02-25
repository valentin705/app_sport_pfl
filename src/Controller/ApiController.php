<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SeanceService;
use App\Service\CategoryService;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route('/api')]
class ApiController extends AbstractController
{
    private TokenStorageInterface $tokenStorage;
    private SeanceService $seanceService;
    private CategoryService $categoryService;
    private UserService $userService;
    private LoggerInterface $logger;

    public function __construct(
        SeanceService $seanceService, 
        CategoryService $categoryService,
        UserService $userService,
        LoggerInterface $logger,
        TokenStorageInterface $tokenStorage
        )
    {

        $this->seanceService = $seanceService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
        $this->logger = $logger;
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/home', name: 'api_home_list')]
    public function apiListeSeances(Request $request): JsonResponse
    {
        $baseUrl = $request->getSchemeAndHttpHost();

        return new JsonResponse([
            'user' => $this->userService->getUserDataForApi($this->getUser(), $baseUrl),
            'categories' => $this->categoryService->getCategoryDataForApi(),
            'seances' => $this->seanceService->getSeanceDataForApi($baseUrl),
        ]);
    }

    #[Route('/user', name: 'api_user')]
    public function getUserDetails(Request $request): JsonResponse
    {
        //log request headers
        $this->logger->info('Request headers: ' . json_encode($request->headers->all()));

        $token = $this->tokenStorage->getToken();
        if (!$token) {
            return $this->json(['error' => 'Token non trouvé'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $user = $token->getUser();

        if (!$user) {
            return $this->json(['error' => 'Utilisateur non trouvé'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user' => $this->userService->getUserPublicData($user),
        ]);
    }
}