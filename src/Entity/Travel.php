<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TravelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TravelRepository::class)]
#[ApiResource()]
class Travel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]   
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $arrival = null;

    #[ORM\Column(length: 255)]
    private ?string $departure = null;

    #[ORM\Column]
    private ?int $numberOfPeople = null;

    #[ORM\Column]
    private ?int $numberOfRoom = null;

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrival(): ?string
    {
        return $this->arrival;
    }

    public function setArrival(string $arrival): static
    {
        $this->arrival = $arrival;

        return $this;
    }

    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    public function setDeparture(string $departure): static
    {
        $this->departure = $departure;

        return $this;
    }

    public function getNumberOfPeople(): ?int
    {
        return $this->numberOfPeople;
    }

    public function setNumberOfPeople(int $numberOfPeople): static
    {
        $this->numberOfPeople = $numberOfPeople;

        return $this;
    }

    public function getNumberOfRoom(): ?int
    {
        return $this->numberOfRoom;
    }

    public function setNumberOfRoom(int $numberOfRoom): static
    {
        $this->numberOfRoom = $numberOfRoom;

        return $this;
    }

}
