<?php

namespace App\Controller;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetAuthorContactsController extends AbstractController
{
    public function __invoke(Author $author)
    {
        $contacts = $author->getContacts();

        return $contacts;
    }
}