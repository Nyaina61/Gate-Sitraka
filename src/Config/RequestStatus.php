<?php

namespace App\Config;

enum RequestStatus: string
{
    case PENDING = 'en attente';
    case ACCEPTED = 'accepté';
}