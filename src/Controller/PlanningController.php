<?php

namespace App\Controller;

use DateTime;
use App\Entity\Calendar;
use App\Form\CalendarType;
use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{

    /**
     * @Route("/planning", name="planning", methods={"GET"})
     */
    public function index(CalendarRepository $calendarRepository): Response
    {
        $events = $calendarRepository->findAll(); 
        $rdvs = [];
        foreach($events as $event){
            if($event->getFerie()){
                $rdvs[] = [
                    'id' => $event->getId(),
                    'start' => $event->getStart()->format('Y-m-d H:i:s'),
                    'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                    'title' => $event->getTitle(),
                    'description' => $event->getDescription(),
                    'backgroundColor' => 'grey',
                    'borderColor' => 'grey',
                    'textColor' => $event->getTextColor(),
                    'allDay' => true,
                    'editable' => false,

                ];   
            }else{
                $rdvs[] = [
                    'id' => $event->getId(),
                    'start' => $event->getStart()->format('Y-m-d H:i:s'),
                    'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                    'title' => $event->getTitle(),
                    'description' => $event->getDescription(),
                    'backgroundColor' => $event->getBackgroundColor(),
                    'borderColor' => $event->getBorderColor(),
                    'textColor' => $event->getTextColor(),
                    'allDay' => $event->getAllDay(),
                    'editable' => true,

                ];
            }   
        }
        $data = json_encode($rdvs);
        return $this->render('planning/index.html.twig', compact('data'));
    }

    /**
     * @Route("planning/list", name="planning_list", methods={"GET"})
     */
    public function list(CalendarRepository $calendarRepository): Response
    {
        return $this->render('planning/listCalendar.html.twig', [
            'calendars' => $calendarRepository->findAll(),
        ]);
    }

    /**
     * @Route("planning/new", name="planning_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $calendar = new Calendar();
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($calendar);
            $entityManager->flush();

            return $this->redirectToRoute('planning');
        }

        return $this->render('planning/new.html.twig', [
            'calendar' => $calendar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("planning/{id}", name="planning_show", methods={"GET"})
     */
    public function show(Calendar $calendar): Response
    {
        return $this->render('planning/show.html.twig', [
            'calendar' => $calendar,
        ]);
    }

    /**
     * @Route("planning/{id}/edit", name="planning_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Calendar $calendar): Response
    {
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planning');
        }

        return $this->render('planning/edit.html.twig', [
            'calendar' => $calendar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("planning/{id}", name="planning_delete", methods={"POST"})
     */
    public function delete(Request $request, Calendar $calendar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendar->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($calendar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planning');
    }

    
    /**
     * @Route("planning/{id}/maj", name="planning_event_maj", methods={"PUT"})
     */
    public function majEvent(?Calendar $calendar , Request $request): Response
    {
        $donnees = json_decode($request->getContent());

        if( isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->borderColor) && !empty($donnees->borderColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor) 
        )
        {
            $code=200;
            if(!$calendar){
                $calendar = new calendar;
                $code = 201;
            }

            $calendar->setTitle($donnees->title);
            $calendar->setDescription($donnees->description);
            $calendar->setStart(new DateTime($donnees->start));
            if($donnees->allDay){
                $calendar->setEnd(new DateTime($donnees->start));
            }else{
                $calendar->setEnd(new DateTime($donnees->end));
            }
            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setBorderColor($donnees->borderColor);
            $calendar->setTextColor($donnees->textColor);

            $this->getDoctrine()->getManager()->persist($calendar);
            $this->getDoctrine()->getManager()->flush();

            return new Response('Ok', $code);
        }else{
            return new Response('données incomplètes', 404);
        }
        return null ;
    }

}
