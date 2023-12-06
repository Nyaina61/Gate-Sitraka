<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\UserExtraData;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{
 private ManagerRegistry $doctrine;

 public function __construct(ManagerRegistry $doctrine)
 {
     $this->doctrine = $doctrine;
 }

 #[Route('/authors/{id}/extraData', methods: ['POST'])]
 public function createCategoryForUser(int $id, Request $request, EntityManagerInterface $entityManager): Response
 {
     // Récupérer l'utilisateur
     $author = $this->doctrine->getRepository(Author::class)->find($id);

     if (!$author) {
         throw $this->createNotFoundException('No user found for id '.$id);
     }

     // Récupérer les données de la requête
     $data = json_decode($request->getContent(), true);

     // Créer une nouvelle instance de Category
     $extraData = new UserExtraData();
     $extraData->setTitle($data['title']);
     $extraData->setContent($data['content']);
     $extraData->setPostedBy($author);

     // Associer la catégorie à l'utilisateur
     $author->addExtraData($extraData);

     // Persister l'utilisateur et la nouvelle catégorie
     $entityManager->persist($author);
     $entityManager->flush();

     // Retourner une réponse
     return new Response('Category created successfully', Response::HTTP_CREATED);
 }
}
