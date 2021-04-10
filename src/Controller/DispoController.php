<?php

namespace App\Controller;

use DateTime;
use App\Entity\Intervenants;
use App\Entity\Disponnibilites;
use App\Form\DispoType;
use App\Repository\DisponnibilitesRepository;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;



class DispoController extends AbstractController
{
    
   /**
     * @Route("/dispo", name="disponnibilite", methods={"GET"})
     */
    public function index(Session $session, DisponnibilitesRepository $dispoRepository): Response
    {
        if($session->get('role') == 'Intervenant')
        {
            $idIntervenant = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['id' => $session->get('id')]);

            
            $events = $dispoRepository->findBy(['idinter' => $idIntervenant->getId()]);
            $dispos = [];
            foreach($events as $event){
                $dispo[] = [
                    'id' => $event->getId(),
                    'start' => $event->getStart()->format('Y-m-d H:i:s'),
                    'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                    'title' => 'Indispo',
                    'description' => $event->getDescription(),
                    'backgroundColor' => 'black',
                    'borderColor' => 'black',
                    'textColor' =>'white',
                    'allDay' => $event->getAllDay(),
                    'idinter' => $event->getIdinter()->getId(),
                ];
            }
        }
        else
        {
            $events = $dispoRepository->findAll(); 
            $dispos = [];
            foreach($events as $event){
                    $dispos[] = [
                        'id' => $event->getId(),
                        'start' => $event->getStart()->format('Y-m-d H:i:s'),
                        'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                        'title' => 'Indispo',
                        'description' => $event->getDescription(),
                        'backgroundColor' => 'black',
                        'borderColor' => 'black',
                        'textColor' =>'white',
                        'allDay' => $event->getAllDay(),
                        'idinter' => $event->getIdinter()->getId(),

                    ];   
            }
            
        }

        $data = json_encode($dispos);
        return $this->render('dispo/index.html.twig', compact('data'));
    }

    /**
     * @Route("dispo/list", name="disponnibilite_list", methods={"GET"})
     */
    public function list(DisponnibilitesRepository $dispoRepository): Response
    {
        return $this->render('dispo/listDispo.html.twig', [
            'dispos' => $dispoRepository->findAll(),
        ]);
    }

    /**
     * @Route("dispo/new", name="disponnibilite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dispo = new Disponnibilites();
        $form = $this->createForm(DispoType::class, $dispo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dispo);
            $entityManager->flush();

            return $this->redirectToRoute('disponnibilite');
        }

        return $this->render('dispo/new.html.twig', [
            'dispo' => $dispo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("dispo/{id}", name="disponibilite_show", methods={"GET"})
     */
    public function show(Disponnibilites $dispo): Response
    {
        return $this->render('dispo/show.html.twig', [
            'dispo' => $dispo,
        ]);
    }

    /**
     * @Route("dispo/{id}/edit", name="disponnibilite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Disponnibilites $dispo): Response
    {
        $form = $this->createForm(DispoType::class, $dispo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('disponnibilite');
        }

        return $this->render('dispo/edit.html.twig', [
            'dispo' => $dispo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("dispo/{id}", name="disponnibilite_delete", methods={"POST"})
     */
    public function delete(Request $request, Disponnibilites $dispo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dispo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dispo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('disponnibilite');
    }

    
    /**
     * @Route("dispo/{id}/maj", name="disponnibilite_event_maj", methods={"PUT"})
     */
    public function majEvent(?Disponnibilites $dispo , Request $request): Response
    {
        $donnees = json_decode($request->getContent());

        if( isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description)
        )
        {
            $code=200;
            if(!$dispo){
                $dispo = new Disponnibilite();
                $code = 201;
            }

            $dispo->setDescription($donnees->description);
            $dispo->setStart(new DateTime($donnees->start));
            if($donnees->allDay){
                $dispo->setEnd(new DateTime($donnees->start));
            }else{
                $dispo->setEnd(new DateTime($donnees->end));
            }
            $dispo->setAllDay($donnees->allDay);
            $dispo->setIdInter($this->getDoctrine()->getRepository(Intervenants::class)->find($donnees->idInter));

            $this->getDoctrine()->getManager()->persist($dispo);
            $this->getDoctrine()->getManager()->flush();

            return new Response('Ok', $code);
        }else{
            return new Response('données incomplètes', 404);
        }
        return null ;
    }
}
