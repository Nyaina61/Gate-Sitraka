<?php

namespace App\Entity;

use App\Entity\User;
use ApiPlatform\Metadata\Link;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\DomainRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DomainRepository::class)]
#[ApiResource]
#[ApiResource(
    uriTemplate: '/users/{id}/domains', 
    uriVariables: [
        'id' => new Link(
            fromClass: User::class,
            fromProperty: 'domains'
        )
    ], 
    operations: [new GetCollection()]
)]
#[ApiFilter(SearchFilter::class, properties: ['title' => 'partial'])]
class Domain
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['company_read','invest_read','job_offers_read','users_read', 'posts_read'])]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company_read','invest_read','job_offers_read','users_read', 'posts_read'])]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: Invest::class, inversedBy: 'domains')]
    #[ORM\JoinColumn(nullable:false, onDelete:"CASCADE")]
    private Collection $invest;

    #[ORM\ManyToMany(targetEntity: Company::class, mappedBy: 'domains')]
    #[ORM\JoinColumn(nullable:false, onDelete:"CASCADE")]
    private Collection $companies;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'domains')]
    private Collection $users;

    public function __construct()
    {
        $this->invest = new ArrayCollection();
        $this->companies = new ArrayCollection();
        $this->users = new ArrayCollection();
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Invest>
     */
    public function getInvest(): Collection
    {
        return $this->invest;
    }

    public function addInvest(Invest $invest): static
    {
        if (!$this->invest->contains($invest)) {
            $this->invest->add($invest);
        }

        return $this;
    }

    public function removeInvest(Invest $invest): static
    {
        $this->invest->removeElement($invest);

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
            $company->addDomain($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): static
    {
        if ($this->companies->removeElement($company)) {
            $company->removeDomain($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addDomain($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeDomain($this);
        }

        return $this;
    }

 

    
}
