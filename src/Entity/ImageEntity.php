<?php

namespace App\Entity;


use App\Entity\Post;
use App\Entity\Image;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AuthorRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentableEntityRepository::class)]
#[ApiResource()]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"image_type", type:"string")]
#[ORM\DiscriminatorMap(["thumbnail" => Thumbnail::class])]
abstract class ImageEntity
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['posts_read','image_read','users_read'])]
    public ?string $id = null;

    #[ORM\OneToOne(mappedBy: 'imageEntity', targetEntity: Image::class, orphanRemoval: true)]
    #[Groups(['posts_read','users_read'])]
    private $image;

    // Ajoutez ici les propriétés et méthodes communes à tous les auteurs
    // ...

    private function getId(): ?string
    {
        return $this->id;
    }

 
   

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}

