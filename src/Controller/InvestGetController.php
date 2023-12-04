<?php

namespace App\Controller;

use App\Entity\Invest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Vich\UploaderBundle\Handler\UploadHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InvestGetController extends AbstractController
{
    private $entityManager;
    private $uploadHandler;

    public function __construct(EntityManagerInterface $entityManager, UploadHandler $uploadHandler,private Security $security)
    {
        $this->entityManager = $entityManager;
        $this->uploadHandler = $uploadHandler;
    }

    public function __invoke()
    {
        $repository = $this->entityManager->getRepository(Invest::class);
        $items = $repository->findAll();

        if (count($items) === 0) {
            return new JsonResponse(['message' => 'Aucun Investissement trouvé'], 404);
        }

        $randomItem = $items[array_rand($items)];

        return new JsonResponse(['data' => $randomItem]);

    }
}
