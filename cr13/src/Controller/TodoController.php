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
use App\Entity\Todo;
use App\Form\TodoType;

class TodoController extends AbstractController
{
  #[Route('/', name: 'todo')]
  public function index(ManagerRegistry $doctrine): Response
  {
    $todos = $doctrine->getRepository(Todo::class)->findAll();
    return $this->render('todo/index.html.twig', ['todos' => $todos]);
  }

  #[Route('/create', name: 'todo_create')]
  public function create(Request $request, ManagerRegistry $doctrine, FileUploader $fileUploader): Response
  {
    $todo = new Todo();
    $form = $this->createForm(TodoType::class, $todo);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $todo = $form->getData();
      $pic = $form->get('picture')->getData();
      if ($pic){
        $pictureFileName = $fileUploader->upload($pic);
        $todo->setPicture($pictureFileName);
      }
      $em = $doctrine->getManager();
      $em->persist($todo);
      $em->flush();
      $this->addFlash(
        'notice',
        'Event Added'
      );
      return $this->redirectToRoute('todo');
    }
    return $this->render('todo/create.html.twig', ['form' => $form->createView()]);
  }

  #[Route('/edit/{id}', name: 'todo_edit')]
  public function edit(Request $request, ManagerRegistry $doctrine, $id,FileUploader $fileUploader): Response
  {
    $todo = $doctrine->getRepository(Todo::class)->find($id);
    $form = $this->createForm(TodoType::class, $todo);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $todo = $form->getData();
      $pic = $form->get('picture')->getData();
      if ($pic){
        $pictureFileName = $fileUploader->upload($pic);
        $todo->setPicture($pictureFileName);
      }
      $em = $doctrine->getManager();
      $em->persist($todo);
      $em->flush();
      $this->addFlash(
        'notice',
        'Event Edited'
      );

      return $this->redirectToRoute('todo');
    }

    return $this->render('todo/edit.html.twig', ['form' => $form->createView()]);
  }

  #[Route('/details/{id}', name: 'todo_details')]
  public function details(ManagerRegistry $doctrine, $id): Response
  {
    $todo = $doctrine->getRepository(Todo::class)->find($id);
    return $this->render('todo/details.html.twig', ['todo' => $todo]);
  }

  #[Route('/delete/{id}', name: 'todo_delete')]
  public function delete($id, ManagerRegistry $doctrine): Response
  {
    $todo = $doctrine->getRepository(Todo::class)->find($id);
    $em = $doctrine->getManager();
    $em->remove($todo);
    $em->flush();
    $this->addFlash("success", "Event has been removed successfully");
    return $this->redirectToRoute('todo');
  }
  #[Route('/concert', name: 'concert')]
  public function concert(ManagerRegistry $doctrine): Response
  {
    $todo = $doctrine->getManager();
    $show = $todo->getRepository(Todo::class)->findBy(['type' => 'Concert']);
    return $this->render('todo/concert.html.twig', [
      "todos" => $show
    ]);
  }
  #[Route('/film', name: 'film')]
  public function film(ManagerRegistry $doctrine): Response
  {
    $todo = $doctrine->getManager();
    $show = $todo->getRepository(Todo::class)->findBy(['type' => 'Film']);
    return $this->render('todo/film.html.twig', [
      "todos" => $show
    ]);
  }
  #[Route('/sport', name: 'sport')]
  public function music(ManagerRegistry $doctrine): Response
  {
    $todo = $doctrine->getManager();
    $show = $todo->getRepository(Todo::class)->findBy(['type' => 'Sport']);
    return $this->render('todo/sport.html.twig', [
      "todos" => $show
    ]);
  }
}
