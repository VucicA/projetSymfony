<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controllerName' => 'HomeController',
        ]);
    }

    /**
     * @Route("/", name="racine")
     */
    public function home(){
        return $this->render('home/index.html.twig', [
            'controllerName' => 'HomeController',
        ]);
    }
}
