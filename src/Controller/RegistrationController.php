<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{

    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // création du formulaire
        $user = new User();
        // instancie le formulaire avec les contraintes par défaut, + la contrainte registration pour que la saisie du mot de passe soit obligatoire
        $form = $this->createForm(RegistrationFormType::class, $user,[
           'validation_groups' => array('User', 'registration'),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
 
            // Encode le mot de passe
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
 
            // Enregistre le membre en base
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
 
            return $this->redirectToRoute('home');
        }
 
        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}