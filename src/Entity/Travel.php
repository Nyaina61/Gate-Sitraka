<?php

namespace App\Entity;

use App\Repository\TravelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TravelRepository::class)]
class Travel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $arrival = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $departure = null;

    #[ORM\Column]
    private ?int $numberOfPeople = null;

    #[ORM\Column]
    private ?int $numberOfRoom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrival(): ?\DateTimeInterface
    {
        return $this->arrival;
    }

    public function setArrival(\DateTimeInterface $arrival): static
    {
        $this->arrival = $arrival;

        return $this;
    }

    public function getDeparture(): ?\DateTimeInterface
    {
        return $this->departure;
    }

    public function setDeparture(?\DateTimeInterface $departure): static
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
