<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Entity\Discussion;
use App\Entity\MemberEntity;
use App\Config\ContactStatus;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use App\Exception\UnauthorizedException;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class AcceptPartnerController extends AbstractController
{

    public function __construct(private Security $security)
    {
       
    }

    public function __invoke(Partner $partner,EntityManagerInterface $entityManager,IriConverterInterface $iriConverter): Partner
    {

        $currentUser = $this->security->getUser();
        // Check if the current user is the receiver of the partner
        if ($currentUser !== $partner->getReceiver()->getAuthor()) {
            throw new UnauthorizedException('Vous n\'êtes pas autorisé a effectuer cette action.');
        }
        if ($partner->getStatus() === ContactStatus::ACCEPTED) {
            throw new AccessDeniedException('Ce partenaire a déjà été accepté !');
        }

        // Change the status of the contact to "accepted"
        $partner->setStatus(ContactStatus::ACCEPTED);
       
        return $partner;
    }
}
