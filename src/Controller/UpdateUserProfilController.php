<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserProfilType;

class UpdateUserProfilController extends AbstractController
{
    #[Route('/main/update_user_profil', name: 'update_user_profil')]
    public function updateUserProfil(
        EntityManagerInterface $manager,
        Request $request
    )
    {
        $user = $this->getUser();

        $form = $this->createForm(UserProfilType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_profil');
        }

        return $this->render('main/update_user_profil.html.twig', [
            'formUserProfil' => $form->createView()
        ]);
    }
}
