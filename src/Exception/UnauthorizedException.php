<?php

namespace App\Exception;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException as Unauthorized;

class UnauthorizedException extends Unauthorized
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}