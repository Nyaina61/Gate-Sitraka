<?php

namespace App\Controller;

use App\Entity\UserExtraData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{
   #[Route('/userExtraData', methods: ['POST'])]
   public function createUserExtraData(Request $request, EntityManagerInterface $entityManager): Response
   {
       // Récupérer les données de la requête
       $data = json_decode($request->getContent(), true);

       // Créer une nouvelle instance de Category
       $userExtraData  = new UserExtraData();
       $userExtraData ->setTitle($data['title']);

       // Persister la nouvelle catégorie
       $entityManager->persist($userExtraData);
      $entityManager->flush();

       // Retourner une réponse
       return new Response('Created successfully', Response::HTTP_CREATED);
   }
}

