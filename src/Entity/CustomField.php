<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CustomFieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomFieldRepository::class)]
#[ApiResource()]
class CustomField
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    public ?string $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'customFields')]
    private ?PaysCultures $culture = null;

    #[ORM\Column(length: 255)]
    private ?string $entity = null;

    #[ORM\Column(length: 255)]
    private ?string $entityId = null;

    #[ORM\OneToMany(mappedBy: 'customField', targetEntity: ExtraData::class)]
    private Collection $extraData;

    public function __construct()
    {
        $this->extraData = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(): ?string
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }


    public function getCulture()
    {
        return $this->culture;
    }


    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): static
    {
        $this->entity = $entity;

        return $this;
    }

    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    public function setEntityId(string $entityId): static
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * @return Collection<int, ExtraData>
     */
    public function getExtraData(): Collection
    {
        return $this->extraData;
    }

    public function addExtraData(ExtraData $extraData): static
    {
        if (!$this->extraData->contains($extraData)) {
            $this->extraData->add($extraData);
            $extraData->setCustomField($this);
        }

        return $this;
    }

    public function removeExtraData(ExtraData $extraData): static
    {
        if ($this->extraData->removeElement($extraData)) {
            // set the owning side to null (unless already changed)
            if ($extraData->getCustomField() === $this) {
                $extraData->setCustomField(null);
            }
        }

        return $this;
    }
}
