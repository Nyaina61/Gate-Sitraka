<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\HotelRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
#[ApiResource( 
    normalizationContext:['groups'=>['hotel']]
)]
#[ApiFilter(SearchFilter::class, properties: ['type'=>'partial',
    'location'=>'exact',
    'stars'=>'exact',
    'openingTime'=>'exact',
    'name'=>'exact',

])]

class Hotel
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['hotel'])]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Groups(['hotel'])]
    private ?string $location = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['hotel'])]
    private ?string $stars = null;

    #[ORM\Column(length: 255)]
    #[Groups(['hotel'])]
    private ?string $nifStat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['hotel'])]
    private ?\DateTimeInterface $openingTime = null;

    #[ORM\ManyToOne(inversedBy: 'hotels')]
    #[Groups(['hotel'])]
    private ?Author $author = null;

    #[ORM\Column(length: 255)]
    #[Groups(['hotel'])]
    private ?string $name = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getStars(): ?string
    {
        return $this->stars;
    }

    public function setStars(?string $stars): static
    {
        $this->stars = $stars;

        return $this;
    }

    public function getNifStat(): ?string
    {
        return $this->nifStat;
    }

    public function setNifStat(string $nifStat): static
    {
        $this->nifStat = $nifStat;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of openingTime
     */ 
    public function getOpeningTime()
    {
        return $this->openingTime;
    }

    /**
     * Set the value of openingTime
     *
     * @return  self
     */ 
    public function setOpeningTime($openingTime)
    {
        $this->openingTime = $openingTime;

        return $this;
    }
}
