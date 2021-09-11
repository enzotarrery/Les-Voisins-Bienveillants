<?php

namespace App\Form;

use App\Entity\Tache;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email.',
                    ])
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Veuillez entrer un mot de passe d\'au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre nom.',
                    ])
                ]
            ])
            ->add('prenom', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre prénom.',
                    ])
                ]
            ])
            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    '-- Choisir une civilité --' => null,
                    'M.' => 'M.',
                    'Mme.' => 'Mme.',
                    'Autre' => 'Autre'
                ],
                'constraints' => [
                    new NotNull([
                        'message' => 'Veuillez choisir une civilité.'
                    ])
                ],
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une date de naissance.',
                    ])
                ]
            ])
            ->add('telephone', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un numéro de téléphone',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Veuillez entrer un numéro de téléphone valide',
                        // max length allowed by Symfony for security reasons
                        'max' => 10,
                    ]),
                ]
            ])
            ->add('adresse', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez préciser votre adresse.',
                    ])
                ]
            ])
            ->add('quartier', ChoiceType::class, [
                'choices' => [
                    '-- Choisir un quartier --' => null,
                    'Résidence des couturelles' => 'Résidence des couturelles',
                    'Cité des brebis' => 'Cité des brebis',
                    'Cité alouettes' => 'Cité alouettes',
                    'Mairie-cimetierre' => 'Mairie-cimetierre',
                    'ZAL du Minopole Saint-Maclou' => 'ZAL du Minopole Saint-Maclou',
                    'Résidence Kennedy' => 'Résidence Kennedy'
                ],
                'constraints' => [
                    new NotNull([
                        'message' => 'Veuillez choisir un quartier.'
                    ])
                ],
            ])
            ->add('typeBenevolat', ChoiceType::class, [
                'choices' => [
                    '-- Choisir un type -- ' => null,
                    'Bénévolat classique' => 'Classique',
                    'Heure civique' => 'Heure civique'
                ]
            ])
            ->add('taches', EntityType::class, [
                'class' => Tache::class,

                'choice_label' => 'nom',

                'multiple' => true,
                'expanded' => true,
            ])
            ->add('motivation', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez préciser vos motivations.',
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les termes.',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
