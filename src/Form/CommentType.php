<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Length;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Commentaire',
                    'class' => 'no-resize comment-text w-100 d-flex align-items-center px-3 py-2',
                    'rows' => '1',
                    'cols' => '10'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 300,
                        'minMessage' => 'Votre commentaire doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre commentaire ne doit pas dépasser {{ limit }} caractères'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
