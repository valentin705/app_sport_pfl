<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SeanceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\CategoryRepository;
use App\Form\CategoryType;
use App\Repository\UserRepository;

class HomeController extends AbstractController
{

    #[Route('/main/home', name: 'home_list')]
    public function userConnect(): response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        return $this->render('main/home.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/main/home', name: 'home_list')]
    public function listeSeances(
        SeanceRepository $seanceRepository,
        CategoryRepository $categoryRepository,
    ): Response {

        $categories = $categoryRepository->findAll();
        $seances = $seanceRepository->findBy([], ['id' => 'DESC']);
        $seancesByLikes = $seanceRepository->createdOrderByLikesQueryBuilder();

        return $this->render('main/home.html.twig', [
            'seances' => $seances,
            'seancesByLikes' => $seancesByLikes,
            'categories' => $categories,
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
