<?php

namespace App\Config;

enum ContactStatus: string
{
    case PENDING = 'en attente';
    case ACCEPTED = 'accepté';
}