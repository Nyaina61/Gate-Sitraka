<?php

namespace App\Entity;

use ApiPlatform\Metadata\GetCollection;
use App\Entity\Author;
use App\Entity\Company;
use App\Config\ContactStatus;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\PartnerController;
use App\Repository\PartnerRepository;
use App\Controller\AcceptPartnerController;
use ApiPlatform\Metadata\Post as PostMetadata;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PartnerRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['partner_read']
    ],
)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['partner_read']
    ],
    operations:[
        new GetCollection(),
        new PostMetadata(
            uriTemplate: '/partners',
            controller: PartnerController::class,
            deserialize: false
        ),
        new PostMetadata(
            uriTemplate: '/partners/{id}/accept',
            controller: AcceptPartnerController::class,
            deserialize: false
        ),
        
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['status' => 'exact'])]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['partner_read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:Company::class)]
    #[ORM\JoinColumn(nullable:false)]
    #[Groups(['partner_read'])]
    private $requester;

    #[ORM\ManyToOne(targetEntity:Company::class)]
    #[ORM\JoinColumn(nullable:false)]
    #[Groups(['partner_read'])]
    private $receiver;

    #[Column(type: "string", enumType: ContactStatus::class)]
    #[Assert\Type(type: ContactStatus::class,message:"Status de partenaire invalide")]
    #[Groups(['partner_read'])]
    private $status;

    public function __construct()
    {
        $this->status = ContactStatus::PENDING;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setStatus(ContactStatus $status)
    {
            $this->status = $status;
    }

    public function getStatus():ContactStatus
    {
        return $this->status;
    }

    /**
     * Get the value of requester
     */ 
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * Set the value of requester
     *
     * @return  self
     */ 
    public function setRequester($requester)
    {
        $this->requester = $requester;

        return $this;
    }

    /**
     * Get the value of receiver
     */ 
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of receiver
     *
     * @return  self
     */ 
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }


}
