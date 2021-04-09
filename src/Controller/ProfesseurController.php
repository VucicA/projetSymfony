<?php

namespace App\Controller;

use App\Entity\Intervenants;
use App\Entity\Users;
use App\Entity\InterWithMatiere;
use App\Entity\Matieres;
use App\Form\IntervenantModifierFormType;
use App\Form\IntervenantAjouterFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class ProfesseurController extends AbstractController
{
    /**
     * @Route("/intervenants", name="intervenants_")
     */
    public function index(): Response
    {
        $intervenants = [];

        $intervenants = $this->getDoctrine()->getRepository(Users::class)->findBy(['role' => 'Intervenant']);
        // Liste de tous les intervenants

        // foreach($users as $user){
        //     $id = $user->getId();
        //     $intervenants = $this->getDoctrine()->getRepository(Intervenants::class)->findBy(['IdUsers' => $id]);
        // }
        
        return $this->render('professeur/index.html.twig', [
            'intervenants' => $intervenants,
        ]);
    }

    /**
     * @Route("/intervenant/{id}/modifier", name="intervenant_modifier")
     */
    public function modifier($id, Request $request): Response
    {
        // Recupere un intervenant par son ID
        $intervenant = $this->getDoctrine()->getRepository(Users::class)->find($id);
        $interWithMat = $this->getDoctrine()->getRepository(InterWithMatiere::class)->findBy(['idinter' => $this->getDoctrine()->getRepository(Intervenants::class)->findOneBy(['IdUsers' => $intervenant->getId()])->getId()]);
        // On instancie l'entité Intervenants
        //$intervenant = new Intervenants();
        $matiere = new Matieres();

        // Création de l'objet formulaire
        $form = $this->createForm(IntervenantModifierFormType::class, null, ['intervenant' => $intervenant]);

        // Récupération des données du formulaire
        $form->handleRequest($request);

        // Vérification de l'envoi et le donées du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            if($form->get('idmatiere')->getData() != null && $form->get('idmatiere')->getData() != []){
                // Ecriture dans la base de données
                foreach($interWithMat as $liaison){
                    $this->getDoctrine()->getManager()->remove($liaison);
                    $this->getDoctrine()->getManager()->flush();
                }
                foreach($form->get('idmatiere')->getData() as $matiere ){
                    $matiereWithInter = new InterWithMatiere(); 
                    $matiereWithInter->setIdmat($matiere);
                    $matiereWithInter->setIdinter($this->getDoctrine()->getRepository(Intervenants::class)->findOneBy(['IdUsers' => $intervenant->getId()]));
                    $this->getDoctrine()->getManager()->persist($matiereWithInter);
                    $this->getDoctrine()->getManager()->flush();
                }
            }
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
        $intervenant = $this->getDoctrine()->getRepository(Intervenants::class)->findOneBy(['IdUsers' => $id]);
        
        //$idUser = $intervenant->getIdUsers();
        $user = $this->getDoctrine()->getRepository(Users::class)->find($id);

        $this->getDoctrine()->getManager()->remove($intervenant);
        $this->getDoctrine()->getManager()->flush();
        $this->getDoctrine()->getManager()->remove($user);
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
        $user = new Users();
        $matieres = [];

        // Création de l'objet formulaire
        $form = $this->createForm(IntervenantAjouterFormType::class, null);

        // Récupération des données du formulaire
        $form->handleRequest($request);
 
        
        // Vérification de l'envoi et le données du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            // Ecriture dans la base de données
            $matieres = $form->get('idmatiere')->getData();
            $user->setNom($form->get('nom')->getData());
            $user->setPrenom($form->get('prenom')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPassword($form->get('password')->getData());
            $this->getDoctrine()->getManager()->persist($user);
            $user->setRole('Intervenant');
            $this->getDoctrine()->getManager()->flush();

            $intervenant->setIdUsers($this->getDoctrine()->getRepository(Users::class)->findOneBy(['email' => $user->getEmail()]));

            $this->getDoctrine()->getManager()->persist($intervenant);
            $this->getDoctrine()->getManager()->flush();

            foreach($matieres as $matiere){
                $matiereWithInter = new InterWithMatiere(); 
                $matiereWithInter->setIdmat($matiere);
                $matiereWithInter->setIdinter($this->getDoctrine()->getRepository(Intervenants::class)->findOneBy(['IdUsers' => $this->getDoctrine()->getRepository(Users::class)->findOneBy(['email' => $user->getEmail()])]));
                $this->getDoctrine()->getManager()->persist($matiereWithInter);
                $this->getDoctrine()->getManager()->flush();
            }

            return $this->redirect('/intervenants');
        }
        return $this->render('professeur/addProfesseur.html.twig', [
            'IntervenantAjouterFormType' => $form->createView()
        ]);
    }
    
}
