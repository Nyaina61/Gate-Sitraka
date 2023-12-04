<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Contact;
use App\Config\ContactStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ContactController extends AbstractController
{
    public function __invoke(Request $request, EntityManagerInterface $entityManager, IriConverterInterface $iriConverter): Contact
    {
        // $requesterIri = $request->get('requester');
        // $receiverIri = $request->get('receiver');
        $contactInfo = json_decode($request->getContent());

        $requester = $iriConverter->getResourceFromIri($contactInfo->requester);
        $receiver = $iriConverter->getResourceFromIri($contactInfo->receiver);

        $existingContact = $entityManager->getRepository(Contact::class)
            ->findOneBy([
                'requester' => [$requester, $receiver],
                'receiver' => [$requester, $receiver]
            ]);

        if ($existingContact) {
            throw new BadRequestHttpException('Vous ne pouvez pas dupliquer un contact.');
        }

        // Proceed with creating the new contact
        $contact = new Contact();
        $contact->setRequester($requester);
        $contact->setReceiver($receiver);
        $contact->setStatus(ContactStatus::PENDING);

        $entityManager->persist($contact);
        $entityManager->flush();

        return $contact;
    }
}

