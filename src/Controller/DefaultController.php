<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\TriFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("charte", name="charte")
     */
    public function charte(): Response
    {

        return $this->render('conditions/charte.html.twig');
    }

    /**
     * @Route("conditions", name="conditions")
     */
    public function conditions(): Response
    {

        return $this->render('conditions/conditions.html.twig');
    }
}
