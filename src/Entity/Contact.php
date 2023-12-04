<?php

namespace App\Entity;

use App\Entity\Author;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use App\Config\ContactStatus;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\ContactController;
use App\Repository\ContactRepository;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\AcceptContactController;
use ApiPlatform\Metadata\Post as PostMetadata;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['contact_read']
    ],
    operations:[
        new Get(),
        new GetCollection(),
        new Put(),
        new Patch(),
        new Delete()
    ]
)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['contact_read']
    ],
    operations:[
        new PostMetadata(
            uriTemplate: '/contacts',
            controller: ContactController::class,
            deserialize: false
        ),
        new PostMetadata(
            uriTemplate: '/contacts/{id}/accept',
            controller: AcceptContactController::class,
            deserialize: false
        ),
        
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['status' => 'exact'])]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['contact_read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:Author::class)]
    #[ORM\JoinColumn(nullable:false)]
    #[Groups(['contact_read'])]
    private $requester;

    #[ORM\ManyToOne(targetEntity:Author::class)]
    #[ORM\JoinColumn(nullable:false)]
    #[Groups(['contact_read'])]
    private $receiver;

    #[Column(type: "string", enumType: ContactStatus::class)]
    #[Assert\Type(type: ContactStatus::class,message:"Status de contact invalide")]
    #[Groups(['contact_read'])]
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
