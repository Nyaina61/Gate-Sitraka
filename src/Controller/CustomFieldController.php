<?php

namespace App\Controller;

use App\Entity\CustomField;
use App\Entity\PaysCultures;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomFieldController extends AbstractController
{
  #[Route('/pays/cultures', name: 'app_pays_cultures')]
  public function index(Request $request, ManagerRegistry $managerRegistry): Response
  {
      $paysCultures = new PaysCultures();
      $form = $this->createForm(PaysCultures::class, $paysCultures);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $entityManager = $managerRegistry->getManager();
          $entityManager->persist($paysCultures);
          $entityManager->flush();

          $customField = new CustomField();
          $customField->setEntity('PaysCultures');
          $customField->setEntityId($paysCultures->getId());

          $entityManager->persist($customField);
          $entityManager->flush();

          return $this->redirectToRoute('pays_cultures');
      }

      return $this->render('pays_cultures/index.html.twig', [
          'form' => $form->createView(),
      ]);
  }
}
