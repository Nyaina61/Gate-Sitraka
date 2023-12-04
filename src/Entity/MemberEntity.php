<?php
// src/Entity/MemberEntity.php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Discussion;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post as MetadataPost;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity()]
#[ApiResource()]
class MemberEntity
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer")]
    #[Groups(['discu_read'])]
    private $id;

    #[ORM\ManyToOne(targetEntity:Discussion::class, inversedBy:"members")]
    private $discussion;

    #[ORM\ManyToOne(targetEntity:User::class, cascade:["persist"])]
    #[Groups(['discu_read'])]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscussion(): ?Discussion
    {
        return $this->discussion;
    }

    public function setDiscussion(?Discussion $discussion): self
    {
        $this->discussion = $discussion;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
