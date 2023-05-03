<?php

namespace App\Form;

use App\Entity\Seance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;


class SeanceType extends AbstractType
{

     ///////////////////////////PLUS UTILISE POUR LE MOMENT///////////////////////////////
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'class' => 'form-control mb-3',
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
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Description de ta séance',
                    'rows' => '4',
                    'cols' => '10'
                ]
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'attr' => [
                    'class' => 'form-check'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}
