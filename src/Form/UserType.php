<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email')
        ->add('name')
        ->add('prenom')
        ->add('password',RepeatedType::class, [
            'type'=>PasswordType::class,
            'first_options'=>['label'=>'Password'],
            'second_options'=>['label'=>'Confirm Password']
        ])
        ->add(
            'accounttype', 
            ChoiceType::class, 
            [
                'choices' => [
                    'Etudiant' => 'ET',
                    'Enseigant' => 'EN',
                ],
            'expanded' => true
            ]
        )
        ->add('Submit', SubmitType::class)
        ->add('Annuler',  ResetType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
