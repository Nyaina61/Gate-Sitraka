<?php
// src/Controller/GetInvestmentsController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\InvestRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api/invest', name: 'get_invest')]
class GetInvestmentsController extends AbstractController
{
    private $investRepository;

    public function __construct(InvestRepository $investRepository)
    {
        $this->investRepository = $investRepository;
    }

    #[Route('', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $companyType = $request->query->get('type');

        if (!$companyType) {
            return new JsonResponse(['error' => 'Le paramètre "companyType" est manquant.'], 400);
        }

        $investments = $this->investRepository->findByCompanyType($companyType);

        return $this->json(['investments' => $investments]);
    }
}


