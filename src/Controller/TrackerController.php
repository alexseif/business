<?php

namespace App\Controller;

use App\Entity\Tracker;
use App\Form\TrackerType;
use App\Repository\TrackerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tracker')]
class TrackerController extends AbstractController
{
    #[Route('/', name: 'app_tracker_index', methods: ['GET'])]
    public function index(TrackerRepository $trackerRepository): Response
    {
        return $this->render('tracker/index.html.twig', [
            'trackers' => $trackerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tracker_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TrackerRepository $trackerRepository): Response
    {
        $tracker = new Tracker();
        $form = $this->createForm(TrackerType::class, $tracker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trackerRepository->save($tracker, true);

            return $this->redirectToRoute('app_tracker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tracker/new.html.twig', [
            'tracker' => $tracker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tracker_show', methods: ['GET'])]
    public function show(Tracker $tracker): Response
    {
        return $this->render('tracker/show.html.twig', [
            'tracker' => $tracker,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tracker_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tracker $tracker, TrackerRepository $trackerRepository): Response
    {
        $form = $this->createForm(TrackerType::class, $tracker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trackerRepository->save($tracker, true);

            return $this->redirectToRoute('app_tracker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tracker/edit.html.twig', [
            'tracker' => $tracker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tracker_delete', methods: ['POST'])]
    public function delete(Request $request, Tracker $tracker, TrackerRepository $trackerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tracker->getId(), $request->request->get('_token'))) {
            $trackerRepository->remove($tracker, true);
        }

        return $this->redirectToRoute('app_tracker_index', [], Response::HTTP_SEE_OTHER);
    }
}
