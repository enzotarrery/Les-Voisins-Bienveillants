<?php

namespace App\Form;

use App\Entity\Utilisateur;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom',TextType::class, [
                'required'=>true,
                'attr'=> [
                    'class'=>'form-control',
                    'readonly' => true
                ]
            ])
            ->add('prenom',TextType::class, [
                'required'=>true,
                'attr'=> [
                    'class'=>'form-control',
                    'readonly' => true
                ]
            ])
            ->add('email',TextType::class, [
                'required'=>true,
                'attr'=> [
                    'class'=>'form-control',
                    'readonly' => true
                ]
            ])

            ->add('adresse',TextType::class, [
                'required'=>true,
                'attr'=> [
                    'class'=>'form-control'
                ]
            ])

            ->add('telephone',TextType::class ,[
                'required'=>true,
                'attr'=> [
                    'class'=>'form-control'
                ]
            ])
            ->add('quartier',ChoiceType::class ,[
                'required'=>true,
                'choices' => [
                    'Résidence des couturelles' => 'Résidence des couturelles',
                    'Cité des brebis' => 'Cité des brebis',
                    'Cité alouettes' => 'Cité alouettes',
                    'Mairie-cimetierre' => 'Mairie-cimetierre',
                    'ZAL du Minopole Saint-Maclou' => 'ZAL du Minopole Saint-Maclou',
                    'Résidence Kennedy' => 'Résidence Kennedy'
                ],

                'attr'=> [
                    'class'=>'form-control'
                ]
            ])
            ->add('typeBenevolat',ChoiceType::class ,[
                'required'=>true,
                'choices'=> [
                    'Bénévolat classique'=>'Classique',
                    'Heure civique'=>'Heure civique'
                ],
                'attr'=> [
                    'class'=>'form-control'
                ]
            ])
            /*
            ->add('motivation',TextareaType::class ,[
                'required'=>true,
                'attr'=> [
                    'class'=>'form-control'
                ]
            ]) */

            ->add('estDisponible',ChoiceType::class ,[
                'required'=>true,
                'choices'=>[
                    'Oui'=>true,
                    'Non'=>false
                ],
                'expanded'=>true,
                'multiple'=>false
            ])

            ->add('Valider',SubmitType::class,[
                'attr'=> [
                    'class'=>'btn btn-primary'
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
