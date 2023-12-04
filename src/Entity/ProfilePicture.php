<?php

namespace App\Entity;

use App\Entity\Image;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;

use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use Symfony\Component\Dotenv\Dotenv;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ProfilePictureRepository;
use ApiPlatform\Metadata\Post as MetadataPost;
use Symfony\Component\HttpFoundation\File\File;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use App\Controller\ProfilePictureUploadController;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProfilePictureRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: [
        'groups' => ['profile_pic_read']
    ],
    operations: [
        new Get(),
        new GetCollection(),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: ProfilePictureUploadController::class,
            deserialize: false,
        )
    ]
)]
#[vich\Uploadable]
class ProfilePicture
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['users_read','posts_read','invest_read','comment_read','author_read','profile_pic_read','image_read'])]
    public ?string $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    #[Groups(['msg_read','users_read','posts_read','discu_read','invest_read','comment_read','author_read','profile_pic_read','image_read'])]
    private ?string $fileUrl = null;

    #[ORM\Column]
    #[Groups(['posts_read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Vich\UploadableField(mapping: 'profile_picture_upload', fileNameProperty: 'fileName')]
    private ?File $file = null;

    #[ORM\Column]
    #[Groups(['users_read','posts_read'])]
    private ?bool $active = true;

    #[ORM\ManyToOne(inversedBy: 'profilePictures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $extUrl = null;

    
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreFlush]
    public function generateFileUrl(): ?string
    {
        if ($this->getFileName()) {
            $dotenv = new Dotenv();
            $dotenv->load(__DIR__ . '/../../.env');
            $this->setFileUrl($_ENV['SITE_DOMAIN'] . '/upload/img/profilePicture/' . $this->getFileName());
        }
        return null;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(?string $fileUrl): static
    {
        $this->fileUrl = $fileUrl;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getExtUrl(): ?string
    {
        return $this->extUrl;
    }

    public function setExtUrl(?string $extUrl): static
    {
        $this->extUrl = $extUrl;

        return $this;
    }

    
}
