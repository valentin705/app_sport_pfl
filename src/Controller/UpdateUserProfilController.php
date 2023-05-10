<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserProfilType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UpdateUserProfilController extends AbstractController
{
    #[Route('/main/update_user_profil', name: 'update_user_profil')]
    public function updateUserProfil(
        EntityManagerInterface $manager,
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        SluggerInterface $slugger,
    )
    {
        $user = $this->getUser();

        $form = $this->createForm(UserProfilType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $pictureFile = $form->get('pictureFile')->getData();
            if($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();
                try {
                    $pictureFile->move(
                        $this->getParameter('user_avatar_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $user->setPictureFile($newFilename);
            }
            
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_profil');
        }

        return $this->render('main/update_user_profil.html.twig', [
            'formUserProfil' => $form->createView()
        ]);
    }
}
