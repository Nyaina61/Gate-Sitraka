<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Config\ContactStatus;
use App\Exception\UnauthorizedException;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Bundle\SecurityBundle\Security;

class PartnerController extends AbstractController
{
    public function __construct(private Security $security)
    {

    }
    public function __invoke(Request $request, EntityManagerInterface $entityManager, IriConverterInterface $iriConverter): Partner
    {
        $currentUser = $this->security->getUser();
        $partnerInfo = json_decode($request->getContent());

        $requester = $iriConverter->getResourceFromIri($partnerInfo->requester);
        $receiver = $iriConverter->getResourceFromIri($partnerInfo->receiver);

        if ($currentUser == $requester) {
            $existingPartner = $entityManager->getRepository(Partner::class)
                ->findOneBy([
                    'requester' => [$requester, $receiver],
                    'receiver' => [$requester, $receiver]
                ]);

            if ($existingPartner) {
                dd('ntay');
                throw new BadRequestHttpException('Vous ne pouvez pas dupliquer un partenaire.');
            }

            // Proceed with creating the new partner

            $partner = new Partner();
            $partner->setRequester($requester);
            $partner->setReceiver($receiver);
            $partner->setStatus(ContactStatus::PENDING);

            $entityManager->persist($partner);
            $entityManager->flush();
            return $partner;
        }else{
            throw new UnauthorizedException('Vous n\'êtes pas autorisé a effectuer cette action.');
        }


    }
}

