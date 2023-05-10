<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateExerciceController extends AbstractController
{
    #[Route('/update/exercice', name: 'app_update_exercice')]
    public function index(): Response
    {
        return $this->render('update_exercice/index.html.twig', [
            'controller_name' => 'UpdateExerciceController',
        ]);
    }
}
