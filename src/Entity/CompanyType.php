<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CompanyTypeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanyTypeRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['ct_read']
    ],
)]
#[ApiFilter(SearchFilter::class, properties: ['type' => 'partial'])]
class CompanyType
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['ct_read','company_read','invest_read'])]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ct_read','company_read','invest_read'])]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'companyType', targetEntity: Company::class)]
    private Collection $company;


    public function __construct()
    {
        $this->company = new ArrayCollection();
    }

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
            $company->setCompanyType($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): static
    {
        if ($this->company->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getCompanyType() === $this) {
                $company->setCompanyType(null);
            }
        }

        return $this;
    }


}
