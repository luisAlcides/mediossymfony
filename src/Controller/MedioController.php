<?php

namespace App\Controller;

use App\Entity\Medio;
use App\Form\MedioType;
use App\Repository\MedioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/medio')]
final class MedioController extends AbstractController
{
    #[Route(name: 'app_medio_index', methods: ['GET'])]
    public function index(MedioRepository $medioRepository): Response
    {
        return $this->render('medio/index.html.twig', [
            'medios' => $medioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_medio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $medio = new Medio();
        $form = $this->createForm(MedioType::class, $medio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($medio);
            $entityManager->flush();

            return $this->redirectToRoute('app_medio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medio/new.html.twig', [
            'medio' => $medio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medio_show', methods: ['GET'])]
    public function show(Medio $medio): Response
    {
        return $this->render('medio/show.html.twig', [
            'medio' => $medio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Medio $medio, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MedioType::class, $medio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_medio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medio/edit.html.twig', [
            'medio' => $medio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medio_delete', methods: ['POST'])]
    public function delete(Request $request, Medio $medio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medio->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($medio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_medio_index', [], Response::HTTP_SEE_OTHER);
    }
}
