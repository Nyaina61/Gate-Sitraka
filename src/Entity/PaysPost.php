<?php

namespace App\Entity;

use App\Entity\PaysFile;
// use ApiPlatform\Metadata\Get;
// use ApiPlatform\Metadata\Put;
// use ApiPlatform\Metadata\Patch;
// use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PaysPostRepository;
// use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
// use ApiPlatform\Metadata\Post as MetadataPost;
// use App\Controller\PayPostController;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PaysPostRepository::class)]
#[ApiResource()]
class PaysPost
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    public ?string $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'paysPosts')]
    private ?Pays $pays = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $content = null;

    #[ORM\OneToMany(mappedBy: 'paysPost', targetEntity: PaysFile::class)]
    private Collection $paysFile;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->paysFile = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

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

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, PaysFile>
     */
    public function getPaysFile(): Collection
    {
        return $this->paysFile;
    }

    public function addPaysFile(PaysFile $paysFile): static
    {
        if (!$this->paysFile->contains($paysFile)) {
            $this->paysFile->add($paysFile);
            $paysFile->setPaysPost($this);
        }

        return $this;
    }

    public function removePaysFile(PaysFile $paysFile): static
    {
        if ($this->paysFile->removeElement($paysFile)) {
            // set the owning side to null (unless already changed)
            if ($paysFile->getPaysPost() === $this) {
                $paysFile->setPaysPost(null);
            }
        }

        return $this;
    }

    
}
