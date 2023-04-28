<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\SeanceRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;

class UserProfilVisitedController extends AbstractController
{
    #[Route('/main/user_profil_visited/{id}', name: 'user_profil_visited')]
    public function userProfilVisited(
        string $id,
        SeanceRepository $seanceRepository,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository
    ): Response
    {
        $user = $userRepository->findOneById($id);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $categories = $categoryRepository->findAll();
        $seances = $seanceRepository->findByUser($user);
        $seancesByLikes = $seanceRepository->createdOrderByLikesQueryBuilder();

        return $this->render('main/user_profil_visited.html.twig', [
            'seances' => $seances,
            'seancesByLikes' => $seancesByLikes,
            'categories' => $categories,
            'user' => $user,
        ]);
    }
}