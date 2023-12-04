<?php

namespace App\Controller;

use App\Entity\Contact;
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

class AcceptContactController extends AbstractController
{

    public function __construct(private Security $security)
    {
       
    }

    public function __invoke(Contact $contact,EntityManagerInterface $entityManager,IriConverterInterface $iriConverter): Discussion
    {
        
        // $contactIri = json_decode($request->getContent())->contact;
        // $contact = $iriConverter->getResourceFromIri($contactIri);

        $currentUser = $this->security->getUser();
        // Check if the current user is the receiver of the contact
        if ($currentUser !== $contact->getReceiver()) {
            throw new UnauthorizedException('Vous n\'êtes pas autorisé a effectuer cette action.');
        }
        if ($contact->getStatus() === ContactStatus::ACCEPTED) {
            throw new AccessDeniedException('Ce contact a déjà été accepté !');
        }

        // Change the status of the contact to "accepted"
        $contact->setStatus(ContactStatus::ACCEPTED);
        $entityManager->persist($contact);


        $discussion=new Discussion();
        $requester=new MemberEntity();
        $requester->setUser($contact->getRequester());
        
        $receiver=new MemberEntity();
        $receiver->setUser($currentUser);

        $entityManager->persist($discussion);

        $requester->setDiscussion($discussion);
        $receiver->setDiscussion($discussion);

        $entityManager->persist($requester);
        $entityManager->persist($receiver);

        $entityManager->flush();

        // dd($discussion);
        return $discussion;
    }
}
