<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AboutRepository;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
#[ApiResource(
    normalizationContext:[
        'groups' => ['users_read', 'about_read']
    ]
)]
class About
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;



    #[ORM\ManyToOne(inversedBy: 'about')]
    private ?User $user = null;


    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

   
}
