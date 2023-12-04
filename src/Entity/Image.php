<?php

namespace App\Entity;


use App\Entity\Thumbnail;
use App\Entity\ImageEntity;
use App\Entity\ProfilePicture;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\CommentableEntity;
use App\Repository\ImageRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[ApiResource(
    normalizationContext:[
        'groups'=>['image_read'],
    ],
)]
class Image extends CommentableEntity
{
    #[ORM\OneToOne(targetEntity:ImageEntity::class)]
    #[Groups(['image_read'])]
    private $imageEntity;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * Get the value of imageEntity
     */ 
    public function getImageEntity()
    {
        return $this->imageEntity;
    }

    /**
     * Set the value of imageEntity
     *
     * @return  self
     */ 
    public function setImageEntity($imageEntity)
    {
        $this->imageEntity = $imageEntity;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}


