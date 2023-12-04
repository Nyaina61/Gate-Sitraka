<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\FlagController;
use App\Repository\FlagRepository;
use Symfony\Component\Dotenv\Dotenv;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post as MetadataPost;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: FlagRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: FlagController::class,
            deserialize: false,
        )
    ]
)]
#[Vich\Uploadable]
class Flag
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['country_list','company_read', 'invest_read', 'posts_read'])]
    private ?string $fileUrl = null;

    #[Vich\UploadableField(mapping: 'flag_upload', fileNameProperty: 'fileName')]
    private ?File $file = null;
    

    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    #[ORM\OneToOne(mappedBy: 'flag', cascade: ['persist', 'remove'])]
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
            $this->setFileUrl($_ENV['SITE_DOMAIN'] . '/upload/img/flag/' . $this->getFileName());
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
            $this->pays->setFlag(null);
        }

        // set the owning side of the relation if necessary
        if ($pays !== null && $pays->getFlag() !== $this) {
            $pays->setFlag($this);
        }

        $this->pays = $pays;

        return $this;
    }

}
