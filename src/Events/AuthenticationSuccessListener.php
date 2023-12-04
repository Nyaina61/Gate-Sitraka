<?php

namespace App\Events;

use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {   
        $data=$event->getData();
        $user=$event->getUser();
        if(!$user instanceof UserInterface){
            return;
        }
        $data['user']=[
            "id"=>$event->getUser()->getId(),
            "firstName"=>$event->getUser()->getFirstName(),
            "lastName"=>$event->getUser()->getLastName(),
            "activeProfilePicture"=>$event->getUser()->getActiveProfilePicture(),
            "email"=>$event->getUser()->getEmail(),
            "roles"=>$event->getUser()->getRoles()
        ];

        $event->setData($data);
    }
}
