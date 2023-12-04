<?php

namespace App\Entity;

use App\Entity\Image;
use App\Entity\ImageEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Dotenv\Dotenv;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ThumbnailRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: ThumbnailRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext:[
        'groups'=>['image_read'],
    ],
)]
#[vich\Uploadable]
class Thumbnail extends ImageEntity
{
    #[Vich\UploadableField(mapping: 'post_thumbnail', fileNameProperty: 'fileName', size: 'fileSize')]
    private ?File $file = null;

    #[ORM\Column(type: 'string')]
    private ?string $fileName = null;

    #[ORM\Column(type: 'integer')]
    private ?int $fileSize = null;

    #[ORM\Column]
    #[Groups(['posts_read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'thumbnails', cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post = null;

    #[ORM\Column(length: 255,nullable:false)]
    #[Groups(['posts_read','image_read','users_read'])]
    private ?string $fileUrl = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function preUpdate()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }



    #[ORM\PreFlush]
    public function generateFileUrl(): ?string
    {
        if ($this->getFileName()) {
            $dotenv = new Dotenv();
            $dotenv->load(__DIR__ . '/../../.env');
            $this->setFileUrl($_ENV['SITE_DOMAIN'] . '/upload/img/postThumb/' . $this->getFileName());
        }
        return null;
    }
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(?int $filesSize): static
    {
        $this->fileSize = $filesSize;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
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

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(string $fileUrl): static
    {
        $this->fileUrl = $fileUrl;

        return $this;
    }
}
