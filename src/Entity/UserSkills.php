<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use App\Repository\UserSkillsRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserSkillsRepository::class)]
#[ApiResource(
    normalizationContext:[
        'groups' => ['user_read', 'about_read']
    ]
)]
class UserSkills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null;

    #[Column(type: 'json')]
    #[Groups(['users_read', 'posts_read', 'about_read'])]
    private array $extraData = [];

    #[ORM\ManyToOne(inversedBy: 'skills')]
    private ?About $about = null;


    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get the value of extraData
     */ 
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * Set the value of extraData
     *
     * @return  self
     */ 
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;

        return $this;
    }

    public function getAbout(): ?About
    {
        return $this->about;
    }

    public function setAbout(?About $about): static
    {
        $this->about = $about;

        return $this;
    }
}
