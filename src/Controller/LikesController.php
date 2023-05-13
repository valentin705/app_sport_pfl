<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SeanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LikesRepository;
use App\Entity\Likes;

class LikesController extends AbstractController
{
    #[Route('/likes/seance/{id}', name: 'app_likes')]
    public function likes(
        $id,
        EntityManagerInterface $manager,
        SeanceRepository $seanceRepository,
        LikesRepository $likesRepository
    ): Response {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $seance = $seanceRepository->find($id);
        $user = $this->getUser();
        $verify = $likesRepository->findOneBy([
            'user' => $user,
            'seance' => $seance
        ]);
        if ($verify) {
            $manager->remove($verify);
            $manager->flush();
        } else {
            $like = new Likes();
            $like->setUser($user);
            $like->setSeance($seance);
            $manager->persist($like);
            $manager->flush();
        }
        return $this->redirectToRoute('show_workout', ['id' => $id]);
    }
    #[Route('/main/show_workout', name: 'show_workout')]
    public function countLikes($id, LikesRepository $likesRepository)
    {
        $seance = $likesRepository->findBy(['seance' => $id]);
        $count = count($seance);
        return $count;
    }
}
