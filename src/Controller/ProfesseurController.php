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

    /**
     * @Route("/intervenant/{id}/modifier", name="intervenant_modifier")
     */
    public function modifier($id): Response
    {
        // Liste de tous les intervenants
        $intervenant = $this->getDoctrine()->getRepository(Intervenants::class)->find($id);

        return $this->render('professeur/modifierProfesseur.html.twig', [
            'intervenant' => $intervenant,
        ]);
    }

    /**
     * @Route("/intervenant/{id}/supprimer", name="intervenant_supprimer")
     */
    public function Delete($id): Response
    {
        $intervenant = $this->getDoctrine()->getRepository(Intervenants::class)->find($id);
        $this->getDoctrine()->getManager()->remove($intervenant);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirect('/intervenants');
    }
    
    /**
     * @Route("/intervenant/Ajouter", name="intervenant_ajouter")
     */
    public function Add(): Response
    {
        return $this->render('professeur/addProfesseur.html.twig', []);
    }
    
}
