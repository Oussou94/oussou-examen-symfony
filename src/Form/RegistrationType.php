<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordTypeType;
class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,[
                'attr' => [

                    'placeholder' =>" username",
                    'class'=>"col-3"
                ]
            ])
            ->add('email',TextType::class,[
            'attr' => [

        'placeholder' =>" votre email",
        'class'=>"col-3"
    ]
    ])

            ->add('password',PasswordType::class,[
        'attr' => [

            'placeholder' =>"password",
            'class'=>"col-3"
        ]
    ])
            ->add('confirm_password',PasswordType::class,[
        'attr' => [

            'placeholder' =>"password ",
            'class'=>"col-3"
        ]
    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
