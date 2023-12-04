<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TurnoverRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TurnoverRepository::class)]
#[ApiResource()]
class Turnover
{

    #[ORM\Id]
    #[ORM\Column(type:"string", unique:true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $year = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $turnover = null;

    #[ORM\ManyToOne(inversedBy: 'turnover')]
    private ?Company $company = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getTurnover(): ?string
    {
        return $this->turnover;
    }

    public function setTurnover(string $turnover): static
    {
        $this->turnover = $turnover;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }
}
