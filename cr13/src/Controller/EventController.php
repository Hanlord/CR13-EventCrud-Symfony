<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\FileUploader;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Event;
use App\Form\EventType;

class EventController extends AbstractController
{
  #[Route('/', name: 'event')]
  public function index(ManagerRegistry $doctrine): Response
  {
    $events = $doctrine->getRepository(Event::class)->findAll();
    return $this->render('event/index.html.twig', ['events' => $events]);
  }

  #[Route('/create', name: 'event_create')]
  public function create(Request $request, ManagerRegistry $doctrine, FileUploader $fileUploader): Response
  {
    $event = new Event();
    $form = $this->createForm(EventType::class, $event);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $event = $form->getData();
      $pic = $form->get('picture')->getData();
      if ($pic){
        $pictureFileName = $fileUploader->upload($pic);
        $event->setPicture($pictureFileName);
      }
      $em = $doctrine->getManager();
      $em->persist($event);
      $em->flush();
      $this->addFlash(
        'notice',
        'Event Added'
      );
      return $this->redirectToRoute('event');
    }
    return $this->render('event/create.html.twig', ['form' => $form->createView()]);
  }

  #[Route('/edit/{id}', name: 'event_edit')]
  public function edit(Request $request, ManagerRegistry $doctrine, $id,FileUploader $fileUploader): Response
  {
    $event = $doctrine->getRepository(Event::class)->find($id);
    $form = $this->createForm(EventType::class, $event);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $event = $form->getData();
      $pic = $form->get('picture')->getData();
      if ($pic){
        $pictureFileName = $fileUploader->upload($pic);
        $event->setPicture($pictureFileName);
      }
      $em = $doctrine->getManager();
      $em->persist($event);
      $em->flush();
      $this->addFlash(
        'notice',
        'Event Edited'
      );

      return $this->redirectToRoute('event');
    }

    return $this->render('event/edit.html.twig', ['form' => $form->createView()]);
  }

  #[Route('/details/{id}', name: 'event_details')]
  public function details(ManagerRegistry $doctrine, $id): Response
  {
    $event = $doctrine->getRepository(Event::class)->find($id);
    return $this->render('event/details.html.twig', ['event' => $event]);
  }

  #[Route('/delete/{id}', name: 'event_delete')]
  public function delete($id, ManagerRegistry $doctrine): Response
  {
    $event = $doctrine->getRepository(Event::class)->find($id);
    $em = $doctrine->getManager();
    $em->remove($event);
    $em->flush();
    $this->addFlash("success", "Event has been removed successfully");
    return $this->redirectToRoute('event');
  }
  #[Route('/concert', name: 'concert')]
  public function concert(ManagerRegistry $doctrine): Response
  {
    $event = $doctrine->getManager();
    $show = $event->getRepository(Event::class)->findBy(['type' => 'Concert']);
    return $this->render('event/concert.html.twig', [
      "events" => $show
    ]);
  }
  #[Route('/film', name: 'film')]
  public function film(ManagerRegistry $doctrine): Response
  {
    $event = $doctrine->getManager();
    $show = $event->getRepository(Event::class)->findBy(['type' => 'Film']);
    return $this->render('event/film.html.twig', [
      "events" => $show
    ]);
  }
  #[Route('/sport', name: 'sport')]
  public function music(ManagerRegistry $doctrine): Response
  {
    $event = $doctrine->getManager();
    $show = $event->getRepository(Event::class)->findBy(['type' => 'Sport']);
    return $this->render('event/sport.html.twig', [
      "events" => $show
    ]);
  }
}
