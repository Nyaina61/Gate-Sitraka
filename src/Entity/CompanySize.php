<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CompanySizeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanySizeRepository::class)]
#[ApiResource()]
class CompanySize
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $Size = null;

    #[ORM\OneToMany(mappedBy: 'companySize', targetEntity: Company::class)]
    private Collection $company;

    public function __construct()
    {
        $this->company = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->Size;
    }

    public function setSize(string $Size): static
    {
        $this->Size = $Size;

        return $this;
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompany(): Collection
    {
        return $this->company;
    }

    public function addCompany(Company $company): static
    {
        if (!$this->company->contains($company)) {
            $this->company->add($company);
            $company->setCompanySize($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): static
    {
        if ($this->company->removeElement($company)) {
            if ($company->getCompanySize() === $this) {
                $company->setCompanySize(null);
            }
        }

        return $this;
    }


}
