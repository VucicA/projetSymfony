<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\LoginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;


class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request): Response
    {
        // On instancie l'entité Users
        $user = new Users();

        // Création de l'objet formulaire
        $form = $this->createForm(LoginFormType::class, null);

        // Récupération des données du formulaire
        $form->handleRequest($request);
        
        // Vérification de l'envoi et le donées du formulaire
        if($form->isSubmitted() && $form->isValid())
        {

            $userValidity = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['email' => $form->get('email')->getData()]);

            if($form->get('password')->getData() == $userValidity->getPassword())
            {
                $session = $this->get('session');

                $session->set('id', $userValidity->getId());
                $session->set('role', $userValidity->getRole());               
            }

            // Ecriture dans la base de données
            //$this->getDoctrine()->getManager()->flush();
            return $this->redirect('home');
        }

        return $this->render('security/login.html.twig', [
            'LoginFormType' => $form->createView()
        ]);
    }


    /**
     * @Route("/deco", name="deco")
     */
    public function logout()
    {
        $session = $this->get('session');
        $session->remove('id');
        $session->remove('role');
        //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        return $this->redirect('/');
    }
}