<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
#[ApiResource(
    normalizationContext:[
        'groups'=>['pays_read']
    ]
)]
class Language
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read', 'pays_read'])]
    private ?string $language = null;

    #[ORM\ManyToMany(targetEntity: Pays::class, inversedBy: 'languages')]
    private Collection $pays;

    public function __construct()
    {
        $this->pays = new ArrayCollection();
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): static
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return Collection<int, Pays>
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): static
    {
        if (!$this->pays->contains($pay)) {
            $this->pays->add($pay);
        }

        return $this;
    }

    public function removePay(Pays $pay): static
    {
        $this->pays->removeElement($pay);

        return $this;
    }

}