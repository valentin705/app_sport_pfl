<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{

    ////////////////////////// A traiter //////////////////////////

    // public function buildForm(FormBuilderInterface $builder, array $options): void
    // {
    //     $builder
    //         ->add('q', TextType::class, [
    //             'label' => false,
    //             'attr' => [
    //                 'placeholder' => 'Rechercher'
    //             ]
    //         ])
    //         ->add('query', null, [
    //             'label' => false,
    //             'attr' => [
    //                 'placeholder' => 'Rechercher'
    //             ]
    //         ]);
    // }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'method' => 'GET',
    //         'csrf_protection' => false
    //     ]);
    // }
}
