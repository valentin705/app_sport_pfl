<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SeanceRepository;


class HomeController extends AbstractController
{

    #[Route('/main/home', name: 'home_list')]
    public function userConnect():response 
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        return $this->render('main/home.html.twig', [
            'user' => $user
        ]);
        
    }

    #[Route('/main/home', name: 'home_list')]
    public function listeSeances(SeanceRepository $seanceRepository): Response
    {
        $seances = $seanceRepository->findBy([], ['id' => 'DESC']);

        return $this->render('main/home.html.twig', [
            'seances' => $seances
        ]);
    }

   

}
