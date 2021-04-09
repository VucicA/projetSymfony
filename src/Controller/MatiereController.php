<?php

namespace App\Controller;

use App\Entity\Matieres;
use App\Form\MatiereModifierFormType;
use App\Form\MatiereAjouterFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class MatiereController extends AbstractController
{
    /**
     * @Route("/matieres", name="matieres")
     */
    public function index(): Response
    {
        // Liste de toutes les matieres
        $matieres = $this->getDoctrine()->getRepository(Matieres::class)->findAll();

        return $this->render('matiere/index.html.twig', [
            'matieres' => $matieres,
        ]);
    }

    /**
     * @Route("/matiere/{id}/modifier", name="matiere_modifier")
     */
    public function modifier($id, Request $request): Response
    {
        // Recupere une matiere par son ID
        $matiere = $this->getDoctrine()->getRepository(Matieres::class)->find($id);

        // On instancie l'entité Matieres
        //$matiere = new Matieres();

        // Création de l'objet formulaire
        $form = $this->createForm(MatiereModifierFormType::class, $matiere);

        // Récupération des données du formulaire
        $form->handleRequest($request);

        // Vérification de l'envoi et le donées du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            // Ecriture dans la base de données
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect('/matieres');
        }

        return $this->render('matiere/modifierMatiere.html.twig', [
            'matiere' => $matiere,
            'MatiereModifierFormType' => $form->createView()
        ]);
    }

    /**
     * @Route("/matiere/{id}/supprimer", name="matiere_supprimer")
     */
    public function Delete($id): Response
    {
        $matiere = $this->getDoctrine()->getRepository(Matieres::class)->find($id);
        $this->getDoctrine()->getManager()->remove($matiere);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirect('/matieres');
    }
    
    /**
     * @Route("/matiere/ajouter", name="matiere_ajouter")
     */
    public function Add(Request $request): Response
    {   
        // On instancie l'entité Matieres
        $matiere = new Matieres();

        // Création de l'objet formulaire
        $form = $this->createForm(MatiereAjouterFormType::class, $matiere);

        // Récupération des données du formulaire
        $form->handleRequest($request);

        // Vérification de l'envoi et le donées du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            // Ecriture dans la base de données
            $this->getDoctrine()->getManager()->persist($matiere);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect('/matieres');
        }
        return $this->render('matiere/ajouterMatiere.html.twig', [
            'MatiereAjouterFormType' => $form->createView()
        ]);
    }
}
