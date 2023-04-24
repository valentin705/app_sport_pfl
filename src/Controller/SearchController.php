<?php

namespace App\Controller;

use App\Repository\SeanceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SearchController extends AbstractController
{
        /**
     * @Route("/handleSearch", name="handleSearch")
     * @param Request $request
     */

    public function handleSearch(Request $request,
    SeanceRepository $repoSeance, UserRepository $repoUser)
    {
        $query = $request->request->all('form')['query'];
        if($query) {
            $seances = $repoSeance->findByName($query);
            $users = $repoUser->findByUsername($query);
        }
        return $this->render('search/index.html.twig', [
            'seances' => $seances,
            'users' => $users
        ]);
    }
 
    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé'
                ]
            ])
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        return $this->render('search/searchBar.html.twig', [
            'formSearch' => $form->createView()
        ]);
    }

}
