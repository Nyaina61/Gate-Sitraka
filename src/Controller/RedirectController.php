<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectController extends AbstractController
{
    #[Route('/', name: 'app_redirect')]
    public function index(): RedirectResponse
    {
        return new RedirectResponse('/api');
    }
}
