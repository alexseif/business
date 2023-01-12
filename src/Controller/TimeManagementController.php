<?php

namespace App\Controller;

use App\Entity\TimeManagement;
use App\Form\TimeManagementType;
use App\Manager\TimeManager;
use App\Repository\TimeManagementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/time/management')]
class TimeManagementController extends AbstractController
{
    #[Route('/', name: 'app_time_management_index', methods: ['GET'])]
    public function index(TimeManagementRepository $timeManagementRepository): Response
    {
        $timeManager = new TimeManager();
        $items = $timeManagementRepository->findAll();
        foreach ($items as $item) {
            $timeManager->setETA($item);
        }
        return $this->render('time_management/index.html.twig', [
            'time_managements' => $items,
        ]);
    }

    #[Route('/new', name: 'app_time_management_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TimeManagementRepository $timeManagementRepository): Response
    {
        $timeManagement = new TimeManagement();
        $form = $this->createForm(TimeManagementType::class, $timeManagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeManagementRepository->save($timeManagement, true);

            return $this->redirectToRoute('app_time_management_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('time_management/new.html.twig', [
            'time_management' => $timeManagement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_time_management_show', methods: ['GET'])]
    public function show(TimeManagement $timeManagement): Response
    {
        return $this->render('time_management/show.html.twig', [
            'time_management' => $timeManagement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_time_management_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TimeManagement $timeManagement, TimeManagementRepository $timeManagementRepository): Response
    {
        $form = $this->createForm(TimeManagementType::class, $timeManagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeManagementRepository->save($timeManagement, true);

            return $this->redirectToRoute('app_time_management_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('time_management/edit.html.twig', [
            'time_management' => $timeManagement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_time_management_delete', methods: ['POST'])]
    public function delete(Request $request, TimeManagement $timeManagement, TimeManagementRepository $timeManagementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $timeManagement->getId(), $request->request->get('_token'))) {
            $timeManagementRepository->remove($timeManagement, true);
        }

        return $this->redirectToRoute('app_time_management_index', [], Response::HTTP_SEE_OTHER);
    }
}
