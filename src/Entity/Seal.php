<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FlagRepository;
use Symfony\Component\Dotenv\Dotenv;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\SealController;
use ApiPlatform\Metadata\Post as MetadataPost;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: SealRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: SealController::class,
            deserialize: false,
        )
    ]
)]
#[Vich\Uploadable]
class Seal
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $fileUrl = null;

    #[Vich\UploadableField(mapping: 'seal_upload', fileNameProperty: 'fileName')]
    private ?File $file = null;

    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    #[ORM\OneToOne(mappedBy: 'seal', cascade: ['persist', 'remove'])]
    private ?Pays $pays = null;


    public function getId(): ?string
    {
        return $this->id;
    }

    #[ORM\PreFlush]
    public function generateFileUrl(): ?string
    {
        if ($this->getFileName()) {
            $dotenv = new Dotenv();
            $dotenv->load(__DIR__ . '/../../.env');
            $this->setFileUrl($_ENV['SITE_DOMAIN'] . '/upload/img/seal/' . $this->getFileName());
        }
        return null;
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

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        // unset the owning side of the relation if necessary
        if ($pays === null && $this->pays !== null) {
            $this->pays->setSeal(null);
        }

        // set the owning side of the relation if necessary
        if ($pays !== null && $pays->getSeal() !== $this) {
            $pays->setSeal($this);
        }

        $this->pays = $pays;

        return $this;
    }

}
