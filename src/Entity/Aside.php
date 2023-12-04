<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AsideRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AsideRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups'=> ['aside_read']
    ]
)]
class Aside
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $motto = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $anthem = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $population = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $area = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $populationDensity = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $gdp = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $gdpNominal = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $hdi = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $currency = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $drivingSide = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $callingCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read'])]
    private ?string $internetTld = null;

    #[ORM\OneToOne(mappedBy: 'aside', cascade: ['persist', 'remove'])]
    private ?Pays $pays = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMotto(): ?string
    {
        return $this->motto;
    }

    public function setMotto(?string $motto): static
    {
        $this->motto = $motto;

        return $this;
    }

    public function getAnthem(): ?string
    {
        return $this->anthem;
    }

    public function setAnthem(?string $anthem): static
    {
        $this->anthem = $anthem;

        return $this;
    }

    public function getPopulation(): ?string
    {
        return $this->population;
    }

    public function setPopulation(?string $population): static
    {
        $this->population = $population;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getPopulationDensity(): ?string
    {
        return $this->populationDensity;
    }

    public function setPopulationDensity(?string $populationDensity): static
    {
        $this->populationDensity = $populationDensity;

        return $this;
    }

    public function getGdp(): ?string
    {
        return $this->gdp;
    }

    public function setGdp(?string $gdp): static
    {
        $this->gdp = $gdp;

        return $this;
    }

    public function getGdpNominal(): ?string
    {
        return $this->gdpNominal;
    }

    public function setGdpNominal(?string $gdpNominal): static
    {
        $this->gdpNominal = $gdpNominal;

        return $this;
    }

    public function getHdi(): ?string
    {
        return $this->hdi;
    }

    public function setHdi(?string $hdi): static
    {
        $this->hdi = $hdi;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDrivingSide(): ?string
    {
        return $this->drivingSide;
    }

    public function setDrivingSide(?string $drivingSide): static
    {
        $this->drivingSide = $drivingSide;

        return $this;
    }

    public function getCallingCode(): ?string
    {
        return $this->callingCode;
    }

    public function setCallingCode(?string $callingCode): static
    {
        $this->callingCode = $callingCode;

        return $this;
    }

    public function getInternetTld(): ?string
    {
        return $this->internetTld;
    }

    public function setInternetTld(?string $internetTld): static
    {
        $this->internetTld = $internetTld;

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
            $this->pays->setAside(null);
        }

        // set the owning side of the relation if necessary
        if ($pays !== null && $pays->getAside() !== $this) {
            $pays->setAside($this);
        }

        $this->pays = $pays;

        return $this;
    }

}
