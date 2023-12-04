<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\HttpFoundation\JsonResponse;


class AuthenticationFailureListener
{
    /**
     * @param AuthenticationFailureEvent $event
     */
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
    {

        $response = new JWTAuthenticationFailureResponse('Vos identifiants sont incorrects !', JsonResponse::HTTP_UNAUTHORIZED);

        $event->setResponse($response);
    }
}
