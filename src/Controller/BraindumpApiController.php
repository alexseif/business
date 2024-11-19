<?php

namespace App\Controller;

use App\Entity\Braindump;
use App\Repository\BraindumpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/braindumps')]
class BraindumpApiController extends AbstractController
{
    #[Route('/', name: 'api_braindump_index', methods: ['GET'])]
    public function index(BraindumpRepository $braindumpRepository): JsonResponse
    {
        $braindumps = $braindumpRepository->findAll();
        $data = [];

        foreach ($braindumps as $braindump) {
            $data[] = [
                'id' => $braindump->getId(),
                'name' => $braindump->getName(),
                'dump' => $braindump->getDump(),
            ];
        }

        return $this->json($data);
    }
    public function getLast(BraindumpRepository $braindumpRepository): JsonResponse
    {
        $braindump = $braindumpRepository->findOneBy([], ['id' => 'DESC']);
        return $this->json([
            'id' => $braindump->getId(),
            'name' => $braindump->getName(),
            'dump' => $braindump->getDump()
        ]);
    }
}
