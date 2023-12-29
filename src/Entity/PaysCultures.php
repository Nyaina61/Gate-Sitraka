<?php

namespace App\Entity;

use App\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PaysCulturesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PaysCulturesRepository::class)]
#[ApiResource(
    normalizationContext:
    ['groups'=>['pays_read']]
)]
class PaysCultures implements EntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\OneToMany(mappedBy: 'paysCultures', targetEntity: Pays::class)]
    private Collection $pays;

    #[ORM\OneToMany(mappedBy: 'coutriesCultures', targetEntity: CustomField::class)]
    private Collection $customFields;

    public function __construct()
    {
        $this->pays = new ArrayCollection();
        $this->customFields = new ArrayCollection();

    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Pays>
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): static
    {
        if (!$this->pays->contains($pay)) {
            $this->pays->add($pay);
            $pay->setPaysCultures($this);
        }

        return $this;
    }

    public function removePay(Pays $pay): static
    {
        if ($this->pays->removeElement($pay)) {
            if ($pay->getPaysCultures() === $this) {
                $pay->setPaysCultures(null);
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
            $customField->setCoutriesCultures($this);
        }

        return $this;
    }

    public function removeCustomField(CustomField $customField): static
    {
        if ($this->customFields->removeElement($customField)) {
            // set the owning side to null (unless already changed)
            if ($customField->getCoutriesCultures() === $this) {
                $customField->setCoutriesCultures(null);
            }
        }

        return $this;
    }


}
