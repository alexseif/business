<?php

namespace App\Controller;

use App\Entity\Braindump;
use App\Form\BraindumpType;
use App\Repository\BraindumpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/braindump')]
class BraindumpController extends AbstractController
{
    #[Route('/', name: 'app_braindump_index', methods: ['GET'])]
    public function index(BraindumpRepository $braindumpRepository): Response
    {
        return $this->render('braindump/index.html.twig', [
            'braindumps' => $braindumpRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_braindump_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BraindumpRepository $braindumpRepository): Response
    {
        $braindump = new Braindump();
        $form = $this->createForm(BraindumpType::class, $braindump);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $braindumpRepository->save($braindump, true);

            return $this->redirectToRoute('app_braindump_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('braindump/new.html.twig', [
            'braindump' => $braindump,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_braindump_show', methods: ['GET'])]
    public function show(Braindump $braindump): Response
    {
        return $this->render('braindump/show.html.twig', [
            'braindump' => $braindump,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_braindump_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Braindump $braindump, BraindumpRepository $braindumpRepository): Response
    {
        $form = $this->createForm(BraindumpType::class, $braindump);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $braindumpRepository->save($braindump, true);

            return $this->redirectToRoute('app_braindump_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('braindump/edit.html.twig', [
            'braindump' => $braindump,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_braindump_delete', methods: ['POST'])]
    public function delete(Request $request, Braindump $braindump, BraindumpRepository $braindumpRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$braindump->getId(), $request->request->get('_token'))) {
            $braindumpRepository->remove($braindump, true);
        }

        return $this->redirectToRoute('app_braindump_index', [], Response::HTTP_SEE_OTHER);
    }
}
