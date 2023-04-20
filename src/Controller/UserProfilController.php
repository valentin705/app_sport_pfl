<?php

namespace App\Controller;

use App\Entity\Seance;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\SeanceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserProfilController extends AbstractController
{

    #[Route('/main/user_profil', name: 'user_profil')]
    public function userProfil(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        return $this->render('main/user_profil.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/main/user_profil', name: 'user_profil')]
    public function userSeances(
        SeanceRepository $seanceRepository,
    ): Response {
        $user = $this->getUser();
        $seances = $seanceRepository->findBy(['user' => $user], ['id' => 'DESC']);

        return $this->render('main/user_profil.html.twig', [
            'seances' => $seances
        ]);
    }
}
