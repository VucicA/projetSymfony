<?php

namespace App\Controller;

use App\Entity\Alternants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/alternants", name="alternants_")
     */
    public function index(): Response
    {
        //Liste de tous les alternants 
        $alternants = $this->getDoctrine()->getRepository(Alternants::class)->findAll();

        return $this->render('etudiant/index.html.twig', [
            'alternants' => $alternants,
        ]);
    }

    /**
     * @Route("/alternant/{id}/modifier", name="alternant_modifier")
     */
    public function modifier($id): Response
    {
        // Selectionne un etudiant en particulier 
        $alternant = $this->getDoctrine()->getRepository(Alternants::class)->find($id);

        return $this->render('etudiant/modifierEtudiant.html.twig', [
            'alternant' => $alternant,
        ]);
    }

    /**
     * @Route("/alternant/{id}/supprimer", name="alternant_supprimer")
     */
    public function Delete($id): Response
    {
        $alternant = $this->getDoctrine()->getRepository(Alternants::class)->find($id);
        $this->getDoctrine()->getManager()->remove($alternant);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirect('/alternants');
    }

    /**
     * @Route("/alternant/Ajouter", name="alternant_ajouter")
     */
    public function Add(): Response
    {
        return $this->render('etudiant/addEtudiant.html.twig', []);
    }
}
