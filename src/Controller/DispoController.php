<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DispoController extends AbstractController
{
    /**
     * @Route("/dispo", name="dispo")
     */
    public function index(): Response
    {
        return $this->render('dispo/index.html.twig', [
            'controller_name' => 'DispoController',
        ]);
    }
}
