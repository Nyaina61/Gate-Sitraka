<?php

namespace App\Events;

use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\Company;
use App\Entity\Message;
use App\Entity\Discussion;
use App\Entity\CommentReply;
use App\Entity\Invest;
use App\Entity\PostEvaluation;
use App\Entity\ProfilePicture;
use Symfony\Component\Uid\Uuid;
use App\Entity\AuthorTypeRelation;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Symfony\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostUserSubscriber implements EventSubscriberInterface
{

    public function __construct(private Security $security)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setMembersForDiscussion', EventPriorities::PRE_VALIDATE]
        ];
    }
    public function setMembersForDiscussion(ViewEvent $event)
    {

        $currentUser = $this->security->getUser();
        $method = $event->getRequest()->getMethod();
        if ((($event->getControllerResult() instanceof Post && !($event->getControllerResult()->getAuthor() instanceof Company))
                || $event->getControllerResult() instanceof Comment
                || $event->getControllerResult() instanceof CommentReply
                || $event->getControllerResult() instanceof Company
                || ($event->getControllerResult() instanceof Invest && !($event->getControllerResult()->getAuthor() instanceof Company))
                || $event->getControllerResult() instanceof Message
                || ($event->getControllerResult() instanceof PostEvaluation))
            && ($method === 'POST')
        ) {
            $event->getControllerResult()->setAuthor($currentUser);
        }
        if ($event->getControllerResult() instanceof ProfilePicture && ($method === 'POST')) {
            $user = $this->security->getUser();
            $user->setActiveProfilePicture($event->getControllerResult());
            $event->getControllerResult()->setUser($currentUser);
        }
        
    }
}
