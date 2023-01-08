<?php

namespace App\Controller;

use App\Repository\BraindumpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    #[Route('/', name: 'app_homepage')]
    public function index(BraindumpRepository $braindumpRepository): Response
    {
        $lastBraindump = $braindumpRepository->findOneBy([], ['id' => 'DESC']);
        return $this->render('default/index.html.twig', [
            'lastBraindump' => $lastBraindump
        ]);
    }
}
