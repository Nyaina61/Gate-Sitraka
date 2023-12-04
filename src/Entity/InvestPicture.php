<?php

namespace App\Entity;

use App\Entity\Invest;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Dotenv\Dotenv;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\InvestPictureController;
use App\Repository\InvestPictureRepository;
use ApiPlatform\Metadata\Post as MetadataPost;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: InvestPictureRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    operations:[
        new Get(),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: InvestPictureController::class,
            deserialize: false,
        )
    ]
)]

#[Vich\Uploadable]

class InvestPicture
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'string', unique:true)]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['users_read', 'posts_read','invest_read'])]
    private ?string $fileUrl = null;

    #[ORM\Column]
    #[Groups(['users_read', 'posts_read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['users_read', 'posts_read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[vich\UploadableField(mapping: 'invest_picture_upload', fileNameProperty: 'fileName', size: 'fileSize')]
    private ?File $file = null;

    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    #[ORM\Column(length: 255)]
    private ?string $fileSize = null;

    #[ORM\ManyToOne(inversedBy: 'investPictures')]
    private ?Invest $invest = null;

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
            $this->setFileUrl($_ENV['SITE_DOMAIN'] . '/upload/img/invest/' . $this->getFileName());
        }
        return null;
    }

    public function getId(): ?string
    {
        return $this->id;
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
    
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get the value of FileSize
     */ 
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set the value of FileSize
     *
     * @return  self
     */ 
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    public function getInvest(): ?Invest
    {
        
        return $this->invest;
    }

    public function setInvest(?Invest $invest): static
    {
        $this->invest = $invest;

        return $this;
    }
}
