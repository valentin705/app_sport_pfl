<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function apiLogin(): Response
    {
        // L'authentification est gérée par ApiTokenAuthenticator, donc cette méthode peut rester vide.
        throw new \Exception('Doit être intercepté par ApiTokenAuthenticator avant d\'atteindre ici');
    }
}