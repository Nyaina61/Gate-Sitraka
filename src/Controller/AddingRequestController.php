<?php

namespace App\Controller;

use App\Entity\RequestE;
use App\Config\RequestStatus;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use App\Exception\UnauthorizedException;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class AddingRequestController extends AbstractController
{

    public function __construct(private Security $security)
    {
       
    }

    public function __invoke(RequestE $requestE,EntityManagerInterface $entityManager,IriConverterInterface $iriConverter): RequestE
    {
        

        $currentUser = $this->security->getUser();
        if ($currentUser !== $requestE->getReceiver()) {
            throw new UnauthorizedException('Vous n\'êtes pas autorisé a effectuer cette action.');
        }
        if ($requestE->getStatus() === requestStatus::ACCEPTED) {
            throw new AccessDeniedException('Ce contact a déjà accepté !');
        }

        $requestE->setStatus(RequestStatus::ACCEPTED);
        $entityManager->persist($requestE);

        return $requestE;
    }
}
