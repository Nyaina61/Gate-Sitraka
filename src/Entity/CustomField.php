<?php

namespace App\Entity;

use App\Repository\CustomFieldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomFieldRepository::class)]
class CustomField
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'customFields')]
    private ?Pays $countries = null;

    #[ORM\ManyToOne(inversedBy: 'customFields')]
    private ?PaysCultures $coutriesCultures = null;

    #[ORM\ManyToOne(inversedBy: 'customFields')]
    private ?PaysDemog $paysDemog = null;

    #[ORM\ManyToOne(inversedBy: 'customFields')]
    private ?PaysEconomy $CountriesEconomy = null;

    #[ORM\ManyToOne(inversedBy: 'customFields')]
    private ?PaysGeography $coutriesGeography = null;

    #[ORM\ManyToOne(inversedBy: 'customFields')]
    private ?PaysGouvernment $countriesGouvernment = null;

    #[ORM\ManyToOne(inversedBy: 'customFields')]
    private ?PaysHistory $countriesHistory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountries(): ?Pays
    {
        return $this->countries;
    }

    public function setCountries(?Pays $countries): static
    {
        $this->countries = $countries;

        return $this;
    }

    public function getCoutriesCultures(): ?PaysCultures
    {
        return $this->coutriesCultures;
    }

    public function setCoutriesCultures(?PaysCultures $coutriesCultures): static
    {
        $this->coutriesCultures = $coutriesCultures;

        return $this;
    }

    public function getPaysDemog(): ?PaysDemog
    {
        return $this->paysDemog;
    }

    public function setPaysDemog(?PaysDemog $paysDemog): static
    {
        $this->paysDemog = $paysDemog;

        return $this;
    }

    public function getCountriesEconomy(): ?PaysEconomy
    {
        return $this->CountriesEconomy;
    }

    public function setCountriesEconomy(?PaysEconomy $CountriesEconomy): static
    {
        $this->CountriesEconomy = $CountriesEconomy;

        return $this;
    }

    public function getCoutriesGeography(): ?PaysGeography
    {
        return $this->coutriesGeography;
    }

    public function setCoutriesGeography(?PaysGeography $coutriesGeography): static
    {
        $this->coutriesGeography = $coutriesGeography;

        return $this;
    }

    public function getCountriesGouvernment(): ?PaysGouvernment
    {
        return $this->countriesGouvernment;
    }

    public function setCountriesGouvernment(?PaysGouvernment $countriesGouvernment): static
    {
        $this->countriesGouvernment = $countriesGouvernment;

        return $this;
    }

    public function getCountriesHistory(): ?PaysHistory
    {
        return $this->countriesHistory;
    }

    public function setCountriesHistory(?PaysHistory $countriesHistory): static
    {
        $this->countriesHistory = $countriesHistory;

        return $this;
    }
}
