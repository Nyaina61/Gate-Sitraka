<?php

namespace App\Controller;

use App\Entity\RequestE;
use App\Config\RequestStatus;
use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RequestController extends AbstractController
{
    public function __invoke(Request $request, EntityManagerInterface $entityManager, IriConverterInterface $iriConverter): RequestE
    {
        $contactInfo = json_decode($request->getContent());

        $requester = $iriConverter->getResourceFromIri($contactInfo->requester);
        $receiver = $iriConverter->getResourceFromIri($contactInfo->receiver);

        $existingContact = $entityManager->getRepository(RequestE::class)
            ->findOneBy([
                'requester' => [$requester, $receiver],
                'receiver' => [$requester, $receiver]
            ]);

        if ($existingContact) {
            throw new BadRequestHttpException('Vous ne pouvez pas dupliquer un contact.');
        }

        // Proceed with creating the new contact
        $contact = new RequestE();
        $contact->setRequester($requester);
        $contact->setReceiver($receiver);
        $contact->setStatus(RequestStatus::PENDING);

        $entityManager->persist($contact);
        $entityManager->flush();

        return $contact;
    }
}
