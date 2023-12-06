<?php
namespace App\Controller;

use App\Entity\ExtraData;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExtraDataController extends AbstractController
{
 private ManagerRegistry $doctrine;

 public function __construct(ManagerRegistry $doctrine)
 {
    $this->doctrine = $doctrine;
 }

 #[Route('/{entity}/{id}/extraData', methods: ['POST'])]
 public function createExtraDataForEntity(string $entity, int $id, Request $request, EntityManagerInterface $entityManager): Response
 {
    // Récupérer l'entité
    $entityClass = 'App\\Entity\\' . ucfirst($entity);
    $entityInstance = $this->doctrine->getRepository($entityClass)->find($id);

    if (!$entityInstance) {
        throw $this->createNotFoundException('No '.$entity.' found for id '.$id);
    }

    // Récupérer les données de la requête
    $data = json_decode($request->getContent(), true);

    // Créer une nouvelle instance de ExtraData
    $extraData = new ExtraData();
    $extraData->setTitle($data['title']);
    $extraData->setContent($data['content']);

    // Associer la ExtraData à l'entité
    $entityInstance->addExtraData($extraData);

    // Persister l'entité et la nouvelle ExtraData
    $entityManager->persist($entityInstance);
    $entityManager->flush();

    // Retourner une réponse
    return new Response('ExtraData created successfully', Response::HTTP_CREATED);
 }
}
