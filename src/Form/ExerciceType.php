<?php

namespace App\Form;

use App\Entity\Exercice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ButtonType;

///////////////////////////A FAIRE  : Modifier le form pour repetition/temps///////////////////////////////
// use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de l\'exercice'
            ])
            ->add('picture', null, [
                'label' => 'Image'
            ])
            ->add('description', null, [
                'label' => 'Description de l\'exercice'
            ])
            ->add('serie', null, [
                'label' => 'Nombre de série'
            ])
        //         ->add('choice', ChoiceType::class, [
        //     'label' => 'Choix',
        //     'choices' => [
        //         'Nombre de répétitions' => 'repetition',
        //         'Temps d\'exécution' => 'temps',
        //     ],
        //     'expanded' => true,
        //     'multiple' => false,
        //     'required' => true,
        // ])
        // ->add('value', null, [
        //     'label' => 'Valeur',
        //     'required' => true,
        // ])
            ->add('repetition', null, [
                'label' => 'Nombre de répétition'
            ])
            ->add('temps', null, [
                'label' => 'Temps d\'exécution'
            ])
            ->add('recuperation', null, [
                'label' => 'Temps de récupération'
            ])
            // ->add('ajouter', ButtonType::class, [ // Ajouter un bouton "Ajouter un exercice supplémentaire"
            //     'label' => 'Ajouter un exercice supplémentaire',
            //     'attr' => [
            //         'class' => 'btn btn-primary', // Classe CSS du bouton
            //     ],
            // ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,

        ]);
    }
}
