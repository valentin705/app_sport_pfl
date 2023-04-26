<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Seance;
use App\Form\SeanceType;
use App\Repository\SeanceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;

class AddExerciseController extends AbstractController
{
    #[Route('/main/add_exercise/{id}', name: 'add_exercise')]
    public function ajouterExercice(
        Seance $seance,
        Request $request,   
        EntityManagerInterface $manager,
    ) {
        $exercice = new Exercice();
        $exercice->setSeance($seance);

        $form = $this->createForm(ExerciceType::class, $exercice);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($exercice);
            $manager->flush();

            return $this->redirectToRoute(
                'add_exercise', ['id' => $seance->getId()]
            );
        }

        return $this->render('main/add_exercise.html.twig', [
            'exercice' => $exercice,
            'formExercice' => $form->createView(),
            'seance' => $seance,
        ]);
        
    }
   
}
