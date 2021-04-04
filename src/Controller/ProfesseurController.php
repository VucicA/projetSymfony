<?php

namespace App\Controller;

use App\Entity\Intervenants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesseurController extends AbstractController
{
    /**
     * @Route("/intervenants", name="intervenants_")
     */
    public function index(): Response
    {
        // Liste de tous les intervenants
        $intervenants = $this->getDoctrine()->getRepository(Intervenants::class)->findAll();

        return $this->render('professeur/index.html.twig', [
            'intervenants' => $intervenants,
        ]);
    }
}
