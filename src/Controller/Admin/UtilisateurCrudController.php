<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            TextField::new('civilite', 'Civilité'),
            TextField::new('prenom', 'Prénom'),
            TextField::new('nom'),
            DateField::new('dateNaissance', 'Date de naissance'),
            TextField::new('telephone', 'Téléphone'),
            TextField::new('adresse'),
            TextField::new('quartier'),
            AssociationField::new('taches'),
            TextField::new('motivation'),
            BooleanField::new('estDisponible', 'Est disponible ?'),
            TextField::new('typeBenevolat', 'Type de bénévolat')
        ];
    }

      public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(ChoiceFilter::new('quartier')->setChoices([
                'Résidence des couturelles' => 'Résidence des couturelles',
                'Cité des brebis' => 'Cité des brebis',
                'Cité alouettes' => 'Cité alouettes',
                'Mairie-cimetierre' => 'Mairie-cimetierre',
                'ZAL du Minopole Saint-Maclou' => 'ZAL du Minopole Saint-Maclou',
                'Résidence Kennedy' => 'Résidence Kennedy'
            ]))
            ->add(ChoiceFilter::new('typeBenevolat')->setChoices([
                'Bénévolat classique' => 'Classique',
                'Heure civique' => 'Heure civique',
            ]))
            ->add(EntityFilter::new('taches'))
            ->add(BooleanFilter::new('estDisponible'))
        ;
    }
}
