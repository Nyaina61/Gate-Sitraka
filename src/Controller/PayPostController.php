<?php

namespace App\Controller;

use App\Entity\Flag;
use App\Entity\Pays;
use App\Entity\Seal;
use App\Entity\Aside;
use App\Entity\Language;
use App\Entity\Location;
use App\Entity\PaysCultures;
use App\Entity\PaysDemog;
use App\Entity\PaysEconomy;
use App\Entity\PaysGeography;
use App\Entity\PaysGouvernment;
use App\Entity\PaysHistory;
use App\Entity\Religion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class PayPostController extends AbstractController
{
    #[Route('/pay/post', name: 'app_pay_post', methods: ['POST'])]
    public function __invoke(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Pays
    {   

        $paysData = $request->request->all();
       

        $pays = new Pays();
        $pays->setName($paysData['name']);

        $aside =  $serializer->deserialize($paysData['aside'], Aside::class,'json');

        $aside->setMotto($aside->getMotto());
        $aside->setAnthem($aside->getAnthem());
        $aside->setArea($aside->getArea());
        $aside->setPopulation($aside->getPopulation());
        $aside->setPopulationDensity($aside->getPopulationDensity());
        $aside->setGdp($aside->getGdp());
        $aside->setGdpNominal($aside->getGdpNominal());
        $aside->setHdi($aside->getHdi());
        $aside->setCurrency($aside->getCurrency());
        $aside->setDrivingSide($aside->getDrivingSide());
        $aside->setCallingCode($aside->getCallingCode());
        $aside->setInternetTld($aside->getInternetTld());

        $pays->setAside($aside);

        $flagFile = $request->files->get('flag');
        if ($flagFile)
        {
          $flag= new Flag();
          $flag->setFile($flagFile);
          $entityManager->persist($flag);
          $pays->setFlag($flag);
        }

        $sealFile = $request->files->get('seal');
        if ($sealFile)
        {
          $seal= new Seal();
          $seal->setFile($sealFile);
          $entityManager->persist($seal);
          $pays->setSeal($seal);
        }

         // Créer une nouvelle instance de Histoire et définir les valeurs
         $history = new PaysHistory();
         $historyData = json_decode($paysData['paysHistory'], true);
         $history->setExtraData($historyData);
         $pays->setPaysHistory($history);
 
         // Créer une nouvelle instance de Geographie et définir les valeurs
         $geography = new PaysGeography();
         $geographyData = json_decode($paysData['paysGeography'], true);
         $geography->setExtraData($geographyData);
         $pays->setPaysGeography($geography);

          // Créer une nouvelle instance de Demographie et définir les valeurs
        $demog = new PaysDemog();
        $demogData = json_decode($paysData['paysDemog'], true);
        $demog->setExtraData($demogData);
        $pays->setPaysDemog($demog);

        // Créer une nouvelle instance de Cultures et définir les valeurs
        $cultures = new PaysCultures();
        $culturesData = json_decode($paysData['paysCultures'], true);
        $cultures->setExtraData($culturesData);
        $pays->setPaysCultures($cultures);

         // Créer une nouvelle instance de Economy et définir les valeurs
         $economy = new PaysEconomy();
         $economyData = json_decode($paysData['paysEconomy'], true);
         $economy->setExtraData($economyData);
         $pays->setPaysEconomy($economy);
 
         // Créer une nouvelle instance de Gouvernment et définir les valeurs
         $gouvernment = new PaysGouvernment();
         $gouvernmentData = json_decode($paysData['paysGouvernment'], true);
         $gouvernment->setExtraData($gouvernmentData);
         $pays->setPaysGouvernment($gouvernment);

        // Créer une nouvelle instance de Location et définir les valeurs de longitude et latitude

        $location =  $serializer->deserialize($paysData['location'], Location::class,'json');
        if (isset($paysData['location']))
        {
          $location->setLongitude($location->getLongitude());
          $location->setLatitude($location->getLatitude());
        }
        $pays->setLocation($location);


        // Créer une nouvelle instance des religion et définir les valeurs de religion

        $religion = new Religion();
          if (isset($paysData['religion'])) {
            $religion->setReligion($paysData['religion']);
          }
          $pays->addReligion($religion);

        // Créer une nouvelle instance des language et définir les valeurs de language

        $language = new Language();
        if (isset($paysData['language'])) {
          $language->setLanguage($paysData['language']);
        }
        $pays->addLanguage($language);


        // Associer l'instance de Location à l'instance de Pays

        $entityManager->persist($aside);
        $entityManager->persist($location);
        $entityManager->persist($religion);
        $entityManager->persist($history);
        $entityManager->persist($geography);
        $entityManager->persist($economy);
        $entityManager->persist($language);
        $entityManager->persist($demog);
        $entityManager->persist($cultures);
        $entityManager->persist($gouvernment);
        $entityManager->persist($pays);
        $entityManager->flush();

        return $pays;
    }
}
