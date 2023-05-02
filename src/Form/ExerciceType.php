<?php

namespace App\Form;

use App\Entity\Exercice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;



///////////////////////////A FAIRE  : Modifier le form pour repetition/temps///////////////////////////////
// use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de l\'exercice',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Nom de l\'exercice'
                ]
            ])
            ->add('picture', null, [
                'label' => 'Image',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'lien de l\'image'
                ]
            ])
            ->add('description', null, [
                'label' => 'Description de l\'exercice',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Description de l\'exercice',
                    'rows' => '4',
                    'cols' => '10'
                ]
            ])
            ->add('serie', null, [
                'label' => 'Nombre de série',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'exemple "4"'
                ]
            ])
        
            ->add('repetition', null, [
                'label' => 'Nombre de répétition',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'exemple "12"'
                ]
            ])
            ->add('temps', null, [
                'label' => 'Temps d\'exécution (en secondes)',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'exemple "30"'
                ]
            ])
            ->add('recuperation', null, [
                'label' => 'Temps de récupération (en secondes)',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'exemple "90"'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,

        ]);
    }
}
