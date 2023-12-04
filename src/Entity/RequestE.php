<?php

namespace App\Entity;

use App\Entity\Author;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use App\Config\RequestStatus;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post as PostMetadata;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\AddingRequestController;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    normalizationContext: [
        'groups' => ['request_read']
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
        'groups' => ['request_read']
    ],
    operations:[
        new PostMetadata(
            // uriTemplate: '/requests',
            controller: RequestController::class,
            deserialize: false
        ),
        new PostMetadata(
            // uriTemplate: '/requests/{id}/accept',
            controller: AddingRequestController::class,
            deserialize: false
        ),
        
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['status' => 'exact'])]

#[ORM\Entity(repositoryClass: RequestERepository::class)]
class RequestE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:Author::class)]
    #[ORM\JoinColumn(nullable:false)]
    #[Groups(['request_read'])]
    private $requester;

    #[ORM\ManyToOne(targetEntity:Author::class)]
    #[ORM\JoinColumn(nullable:false)]
    #[Groups(['request_read'])]
    private $receiver;

    #[Column(type: "string", enumType: RequestStatus::class)]
    #[Assert\Type(type: RequestStatus::class,message:"Status de contact invalide")]
    #[Groups(['request_read'])]
    private $status;

    public function __construct()
    {
        $this->status = RequestStatus::PENDING;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setStatus(RequestStatus $status)
    {
            $this->status = $status;
    }

    public function getStatus():RequestStatus
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
