<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Company;
use App\Entity\CompanyLogo;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[AsController]
class CreateCompanyController extends AbstractController
{

    public function __construct(private EntityManagerInterface $entityManager, private IriConverterInterface $iriConverter)
    {
    }

    public function __invoke(Request $req): Company
    {

        $company = new Company();
        $requestPost = $req->request;

        $company->setName($requestPost->get(key: 'name'));
        $company->setAdress($requestPost->get(key: 'adress'));
        $company->setCountry($this->iriConverter->getResourceFromIri($requestPost->get(key:'country')));
        $company->setCreationDate(new DateTimeImmutable());
        $company->setDescription($requestPost->get(key: 'description'));
        $company->setNumero($requestPost->get(key: 'numero'));
        $company->setEmail($requestPost->get(key: 'email'));
        $company->setWebSite($requestPost->get(key: 'webSite'));
        $company->setNifStat($requestPost->get(key: 'nifStat'));
        $company->setCompanySize($this->iriConverter->getResourceFromIri($requestPost->get(key: 'companySize')));
        $company->setCompanyType($this->iriConverter->getResourceFromIri($requestPost->get(key: 'companyType')));

        if ($domains = $req->get('domains')) {
            foreach ($domains as $domain) {
                $company->addDomain($this->iriConverter->getResourceFromIri($domain));
            }
        }

        if ($uploadedLogo = $req->files->get('companyLogo')) {
            $objectMedia = new CompanyLogo();
            $objectMedia->setFile($uploadedLogo);
            $company->addCompanyLogo($objectMedia);
            $company->setActiveLogo($objectMedia);
            $objectMedia->setCompany($company);
            $this->entityManager->persist($objectMedia);
        }
        return $company;
    }

}
