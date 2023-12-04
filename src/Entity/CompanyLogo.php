<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Dotenv\Dotenv;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\LogoCompanyController;
use App\Repository\CompanyLogoRepository;
use ApiPlatform\Metadata\Post as MetadataPost;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CompanyLogoRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new Get(),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: LogoCompanyController::class,
            deserialize: false,
        )
    ]
)]
#[Vich\Uploadable]
class CompanyLogo
{
    #[ORM\Id]
    #[ORM\Column(type:"string", unique:true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[Groups(['users_read', 'posts_read','company_read','invest_read','job_offers_read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fileUrl = null;

    #[ORM\Column]
    #[Groups(['users_read', 'posts_read','company_read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['users_read', 'posts_read'])]
    private ?\DateTimeImmutable $UpdatedAt = null;

    #[vich\UploadableField(mapping: 'company_logo_uri', fileNameProperty: 'fileName', size: 'fileSize')]
    private ?File $file = null;

    #[ORM\Column]
    #[Groups(['users_read', 'posts_read','company_read'])]
    private ?bool $active = true;

    #[ORM\ManyToOne(inversedBy: 'companyLogos')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Company $Company = null;

    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    #[ORM\Column(length: 255)]
    private ?string $fileSize = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->UpdatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreFlush]
    public function generateFileUrl(): ?string
    {
        if ($this->getFileName()) {
            $dotenv = new Dotenv();
            $dotenv->load(__DIR__ . '/../../.env');
            $this->setFileUrl($_ENV['SITE_DOMAIN'] . '/upload/img/logo/' . $this->getFileName());
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
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $UpdatedAt): static
    {
        $this->UpdatedAt = $UpdatedAt;

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

    public function getCompany(): ?Company
    {
        return $this->Company;
    }

    public function setCompany(?Company $Company): self
    {
        $this->Company = $Company;

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

    public function getFileSize(): ?string
    {
        return $this->fileSize;
    }

    public function setFileSize(string $fileSize): static
    {
        $this->fileSize = $fileSize;

        return $this;
    }
}


















































































































































































































// created By Nyaina