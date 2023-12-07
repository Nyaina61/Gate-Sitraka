<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Serializer\Filter\GroupFilter;
use App\Entity\Religion;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PaysRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use App\Controller\PayPostController;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\Post as MetadataPost;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: PaysRepository::class)]
#[ApiResource()]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: PayPostController::class,
            deserialize: false
        ),
        new Delete()
    ]
)]
#[ApiFilter(GroupFilter::class, arguments: ['parameterName' => 'groups', 'overrideDefaultGroups' => false])]
#[ApiFilter(SearchFilter::class, properties: ["name" => "partial", 
"religion.religion" => "partial",
"aside.internetTld" => "exact",
"aside.anthem" => "partial"])]
class Pays
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    public ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['aside_read', 'pays_read','country_list','company_read', 'invest_read', 'posts_read','cities_read'])]
    private ?string $name = null;

    #[ORM\OneToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read','cities_read'])]
    private ?Seal $seal = null;

    #[ORM\OneToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private ?Location $location = null;

    #[ORM\OneToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private ?Aside $aside = null;

    #[ORM\OneToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read','country_list','company_read', 'invest_read', 'posts_read'])]
    private ?Flag $flag = null;

    #[ORM\ManyToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private ?PaysHistory $paysHistory = null;

    #[ORM\ManyToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private ?PaysGeography $paysGeography = null;

    #[ORM\ManyToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private ?PaysGouvernment $paysGouvernment = null;

    #[ORM\ManyToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private ?PaysEconomy $paysEconomy = null;

    #[ORM\ManyToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private ?PaysCultures $paysCultures = null;

    #[ORM\ManyToOne(inversedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private ?PaysDemog $paysDemog = null;

    #[ORM\ManyToMany(targetEntity: Religion::class, mappedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private Collection $religions;

    #[ORM\ManyToMany(targetEntity: Language::class, mappedBy: 'pays', cascade: ['persist', 'remove'])]
    #[Groups(['aside_read', 'pays_read'])]
    private Collection $languages;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Company::class, orphanRemoval: true)]
    private Collection $companies;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: City::class, orphanRemoval: true)]
    #[Groups(['aside_read', 'pays_read'])]
    private Collection $cities;

    #[ORM\OneToMany(mappedBy: 'countries', targetEntity: CustomField::class)]
    private Collection $customFields;


    public function __construct()
    {
        $this->religions = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->companies = new ArrayCollection();
        $this->customFields = new ArrayCollection();
    } 

    public function getId(): ?string
    {
        return $this->id;
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

    public function getSeal(): ?Seal
    {
        return $this->seal;
    }

    public function setSeal(?Seal $seal): static
    {
        $this->seal = $seal;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getAside(): ?Aside
    {
        return $this->aside;
    }

    public function setAside(?Aside $aside): static
    {
        $this->aside = $aside;

        return $this;
    }

    public function getFlag(): ?Flag
    {
        return $this->flag;
    }

    public function setFlag(?Flag $flag): static
    {
        $this->flag = $flag;

        return $this;
    }

    public function getPaysHistory(): ?PaysHistory
    {
        return $this->paysHistory;
    }

    public function setPaysHistory(?PaysHistory $paysHistory): static
    {
        $this->paysHistory = $paysHistory;

        return $this;
    }

    public function getPaysGeography(): ?PaysGeography
    {
        return $this->paysGeography;
    }

    public function setPaysGeography(?PaysGeography $paysGeography): static
    {
        $this->paysGeography = $paysGeography;

        return $this;
    }

    public function getPaysGouvernment(): ?PaysGouvernment
    {
        return $this->paysGouvernment;
    }

    public function setPaysGouvernment(?PaysGouvernment $paysGouvernment): static
    {
        $this->paysGouvernment = $paysGouvernment;

        return $this;
    }

    public function getPaysEconomy(): ?PaysEconomy
    {
        return $this->paysEconomy;
    }

    public function setPaysEconomy(?PaysEconomy $paysEconomy): static
    {
        $this->paysEconomy = $paysEconomy;

        return $this;
    }

    public function getPaysCultures(): ?PaysCultures
    {
        return $this->paysCultures;
    }

    public function setPaysCultures(?PaysCultures $paysCultures): static
    {
        $this->paysCultures = $paysCultures;

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

    /**
     * @return Collection<int, Religion>
     */
    public function getReligions(): Collection
    {
        return $this->religions;
    }

    public function addReligion(Religion $religion): static
    {
        if (!$this->religions->contains($religion)) {
            $this->religions->add($religion);
            $religion->addPay($this);
        }

        return $this;
    }

    public function removeReligion(Religion $religion): static
    {
        if ($this->religions->removeElement($religion)) {
            $religion->removePay($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): static
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
            $language->addPay($this);
        }

        return $this;
    }

    public function removeLanguage(Language $language): static
    {
        if ($this->languages->removeElement($language)) {
            $language->removePay($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, City>
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): static
    {
        if (!$this->cities->contains($city)) {
            $this->cities->add($city);
            $city->setCountry($this);
        }

        return $this;
    }

    public function removeCity(City $city): static
    {
        if ($this->cities->removeElement($city)) {
            // set the owning side to null (unless already changed)
            if ($city->getCountry() === $this) {
                $city->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): static
    {
        if (!$this->companies->contains($company)) {
            $this->companies->add($company);
            $company->setCountry($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): static
    {
        if ($this->companies->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getCountry() === $this) {
                $company->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomField>
     */
    public function getCustomFields(): Collection
    {
        return $this->customFields;
    }

    public function addCustomField(CustomField $customField): static
    {
        if (!$this->customFields->contains($customField)) {
            $this->customFields->add($customField);
            $customField->setCountries($this);
        }

        return $this;
    }

    public function removeCustomField(CustomField $customField): static
    {
        if ($this->customFields->removeElement($customField)) {
            // set the owning side to null (unless already changed)
            if ($customField->getCountries() === $this) {
                $customField->setCountries(null);
            }
        }

        return $this;
    }

}




































































































































































































// created By Nyaina