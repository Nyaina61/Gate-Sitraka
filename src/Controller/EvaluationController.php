<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Contact;
use App\Entity\Discussion;
use App\Entity\MemberEntity;
use App\Config\ContactStatus;
use App\Entity\PostEvaluation;
use App\Exception\UnauthorizedException;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class EvaluationController extends AbstractController
{

    public function __construct(private Security $security)
    {
       
    }

    public function __invoke(Request $request,EntityManagerInterface $entityManager,IriConverterInterface $iriConverter)
    {
        $postedEvaluation=json_decode($request->getContent());
        // dd($postedEvaluation);
        $evaluableIri = $postedEvaluation->evaluable;
        $evaluable = $iriConverter->getResourceFromIri($evaluableIri);
        $currentUser = $this->security->getUser();
        $evaluation;
        if($evaluable instanceof Post){
            $evaluation = new PostEvaluation();
            $evaluation->setPost($evaluable);
            $evaluation->setNote($postedEvaluation->note);
        }

        
        // // Check if the current user is the receiver of the contact
        // if ($currentUser !== $contact->getReceiver()) {
        //     throw new UnauthorizedException('Vous n\'êtes pas autorisé a effectuer cette action.');
        // }
        // if ($contact->getStatus() === ContactStatus::ACCEPTED) {
        //     throw new AccessDeniedException('Ce contact a déjà été accepté !');
        // }

        // // Change the status of the contact to "accepted"
        // $contact->setStatus(ContactStatus::ACCEPTED);
        // $entityManager->persist($contact);


        // $discussion=new Discussion();
        // $requester=new MemberEntity();
        // $requester->setUser($contact->getRequester());
        
        // $receiver=new MemberEntity();
        // $receiver->setUser($currentUser);

        // $entityManager->persist($discussion);

        // $requester->setDiscussion($discussion);
        // $receiver->setDiscussion($discussion);

        // $entityManager->persist($requester);
        // $entityManager->persist($receiver);

        // $entityManager->flush();

        // // dd($discussion);
        return $evaluation;
    }
}
