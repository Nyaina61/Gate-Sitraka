<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\LocationRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
#[ApiResource(
    normalizationContext:[
        'groups'=>['pays_read']
    ]
)]
class Location
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read', 'pays_read'])]
    private ?string $latitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['aside_read', 'pays_read'])]
    private ?string $longitude = null;

    #[ORM\OneToOne(mappedBy: 'location', cascade: ['persist', 'remove'])]
    private ?Pays $pays = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static
    {
        $this->longitude = $longitude;

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
            $this->pays->setLocation(null);
        }

        // set the owning side of the relation if necessary
        if ($pays !== null && $pays->getLocation() !== $this) {
            $pays->setLocation($this);
        }

        $this->pays = $pays;

        return $this;
    }

}
