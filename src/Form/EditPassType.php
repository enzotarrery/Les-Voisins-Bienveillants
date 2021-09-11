<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditPassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('password', RepeatedType::class, [

                'type' => PasswordType::class,
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 5,
                        'max' => 128,
                    ]),

                ],

                'first_options' => [
                    'required' => true,
                    'label' => 'Nouveau mot de passe',
                    'attr'=> [
                        'class'=>'form-check'
                    ]
                ],
                'second_options' => [
                    'required' => true,
                    'label' => 'Confirmation du nouveau mot de passe',
                    'attr'=> [
                        'class'=>'form-check'
                    ]
                ],
            ])
            ->add('Valider',SubmitType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
