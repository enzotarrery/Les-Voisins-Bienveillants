<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\EditCompetenceType;
use App\Form\EditPassType;
use App\Form\EditProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;


class UtilisateurController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/profil/modifier", name="profil_modifier")
     */

    public function editProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('profil');
        }

        return $this->render('utilisateur/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/profil/competence", name="profil_competence")
     */

public function editCompetence(Request $request)
{
    $user = $this->getUser();
    $form = $this->createForm(EditCompetenceType::class, $user);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash('message', 'Competence mis à jour');
        return $this->redirectToRoute('profil');
    }

    return $this->render('utilisateur/editcompetence.html.twig', [
        'form' => $form->createView(),
    ]);
}


        /**
         * @Route("/profil/pass/modifier", name="profil_pass_modifier")
         */
    public function changePassword(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(EditPassType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $form->get('password')->getData()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Mot de passe mis à jour');
            return $this->redirectToRoute('profil');

        }else{
            $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
        }


        return $this->render('utilisateur/editpass.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/profil/donnees", name="profil_donnees")
     */

    public function usersData()
    {
        return $this->render('utilisateur/donnees.html.twig');
    }

    /**
     * @Route("/utilisateur/donnees/download", name="utilisateur_donnees_download")
     */

/*
    public function UtilisateurDonneesDownload()
    {
        // On définit les options du PDF
        $pdfOptions = new Options();
        // Police par défaut
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        // On instancie Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);

        // On génère le html
        $html = $this->renderView('users/download.html.twig');

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'user-data-'. $this->getUser()->getId() .'.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);

        return new Response();
    }

*/
    /**
     * @Route("/supprimer", name="utilisateur_donnees_suppression")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function UtilisateurDonneesSuppression(Request $request)
    {
        $user = $this->getUser();
        if($user == null)
        {
            return $this->redirect($this->generateUrl('homepage'));
        }

        $session = new Session();
        $session->invalidate();
        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Votre compte à été supprimé avec succes.');
        return $this->redirectToRoute('homepage');
    }
    /*public function supprimer(Request $request, Utilisateur $utilisateur)
  {
          if($this->isCsrfTokenValid('delete'.$utilisateur->getId(),$request->request->get('_token'))){

          $utilisateur = $utilisateur->getId();
          $this->container->get('security.token_storage')->setToken(null);
          $em=$this->getDoctrine()->getManager();
          $em->remove((object)$utilisateur);
          $em->flush();

          $this->addFlash('success', 'Votre compte utilisateur a bien été supprimé !');
          return $this->redirectToRoute('homepage');

      }else{ $this->addFlash('error','Votre compte n\'as pas pu être supprimé,merci de bien vouloir contacter un administrateur');

          }
      return $this->render('default/delete.html.twig');
  }




      $user = $this->getUser();
      if($user == null);

      $em=$this->getDoctrine()->getManager();
      $em->remove($user);
      $em->flush();

      return $this->redirectToRoute('homepage');
      {
          return $this->redirect($this->generateUrl('homepage'));
      }
      */

/*
    public function UtilisateurDonneesSuppression(Request $request)
    {
        $active = 'delete';
        $user = $this->getUser();

        if($user == null)
        {
            return $this->redirect($this->generateUrl('homepage'));
        }

        $form = $this->createFormBuilder()->getForm();

        if($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()
                ->getManager()
            ;

            $em->remove($user);
            $em->flush();

            $this->get('security.context')->setToken(null);
            $this->get('request')->getSession()->invalidate();

            $request->getSession()->getFlashBag()->add('notice', "Votre compte a bien été supprimé.");

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('homepage', array(
            'form' => $form->createView(),
            'active' => $active
        ));
    }
*/


}
