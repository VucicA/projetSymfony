<?php

namespace App\Controller;

use App\Entity\Intervenants;
use App\Form\IntervenantModifierFormType;
use App\Form\IntervenantAjouterFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function modifier($id, Request $request): Response
    {
        // Liste de tous les intervenants
        $intervenant = $this->getDoctrine()->getRepository(Intervenants::class)->find($id);

        // On instancie l'entité Intervenants
        //$intervenant = new Intervenants();

        // Création de l'objet formulaire
        $form = $this->createForm(IntervenantModifierFormType::class, $intervenant);

        // Récupération des données du formulaire
        $form->handleRequest($request);

        // Vérification de l'envoi et le donées du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            // Ecriture dans la base de données
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect('/intervenants');
        }

        return $this->render('professeur/modifierProfesseur.html.twig', [
            'intervenant' => $intervenant,
            'IntervenantModifierFormType' => $form->createView()
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
    public function Add(Request $request): Response
    {   
        // On instancie l'entité Intervenants
        $intervenant = new Intervenants();

        // Création de l'objet formulaire
        $form = $this->createForm(IntervenantAjouterFormType::class, $intervenant);

        // Récupération des données du formulaire
        $form->handleRequest($request);

        // Vérification de l'envoi et le donées du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            // Ecriture dans la base de données
            $this->getDoctrine()->getManager()->persist($intervenant);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect('/intervenants');
        }
        return $this->render('professeur/addProfesseur.html.twig', [
            'IntervenantAjouterFormType' => $form->createView()
        ]);
    }
    
}
