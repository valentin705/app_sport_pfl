<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{
    // #[Route('/seance/liste', name: 'liste_seances')]
    // public function profilUser(
    //     UserRepository $userRepository,
    //     Security $security
    // ): Response {
    //     $user = $security->getUser();
    //     $user = $userRepository->findBy(['user' => $user]);

    //     return $this->render('seance/liste.html.twig', [
    //         'user' => $user
    //     ]);
    // }
}
