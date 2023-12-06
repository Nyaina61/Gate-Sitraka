<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\AboutController;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use App\Repository\UserExtraDataRepository;
use ApiPlatform\Metadata\Post as MetadataPost;
use ApiPlatform\Metadata\Put;

#[ORM\Entity(repositoryClass: UserExtraDataRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new MetadataPost(
            controller: AboutController::class
        ),
    ],
 )]
 #[ApiResource(
             operations: [
                 new Get(),
                 new MetadataPost(),
                 new Patch(),
                 new Put(),
                 new Delete()
             ]
          )]
class UserExtraData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'userExtraData')]
    private ?About $about = null;

    #[ORM\ManyToOne(inversedBy: 'userExtraData')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Author $postedBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

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

    public function getPostedBy(): ?Author
    {
        return $this->postedBy;
    }

    public function setPostedBy(?Author $postedBy): static
    {
        $this->postedBy = $postedBy;

        return $this;
    }
}
