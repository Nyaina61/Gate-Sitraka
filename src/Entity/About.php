<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AboutRepository;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
#[ApiResource(
    normalizationContext:[
        'groups' => ['users_read', 'about_read']
    ],
    operations:[
        
    ]
)]
class About
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;



    #[ORM\ManyToOne(inversedBy: 'about')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'about', targetEntity: UserExtraData::class)]
    private Collection $userExtraData;

    #[ORM\Column(length: 255)]
    private ?string $highSchool = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $university = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $experience = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $certification = null;

    #[ORM\Column(length: 255)]
    private ?string $lisence = null;

    #[ORM\Column(length: 255)]
    private ?string $skills = null;

    public function __construct()
    {
        $this->userExtraData = new ArrayCollection();
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, UserExtraData>
     */
    public function getUserExtraData(): Collection
    {
        return $this->userExtraData;
    }

    public function addUserExtraData(UserExtraData $userExtraData): static
    {
        if (!$this->userExtraData->contains($userExtraData)) {
            $this->userExtraData->add($userExtraData);
            $userExtraData->setAbout($this);
        }

        return $this;
    }

    public function removeUserExtraData(UserExtraData $userExtraData): static
    {
        if ($this->userExtraData->removeElement($userExtraData)) {
            // set the owning side to null (unless already changed)
            if ($userExtraData->getAbout() === $this) {
                $userExtraData->setAbout(null);
            }
        }

        return $this;
    }

    public function getHighSchool(): ?string
    {
        return $this->highSchool;
    }

    public function setHighSchool(string $highSchool): static
    {
        $this->highSchool = $highSchool;

        return $this;
    }

    public function getUniversity(): ?string
    {
        return $this->university;
    }

    public function setUniversity(?string $university): static
    {
        $this->university = $university;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getCertification(): ?string
    {
        return $this->certification;
    }

    public function setCertification(?string $certification): static
    {
        $this->certification = $certification;

        return $this;
    }

    public function getLisence(): ?string
    {
        return $this->lisence;
    }

    public function setLisence(string $lisence): static
    {
        $this->lisence = $lisence;

        return $this;
    }

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): static
    {
        $this->skills = $skills;

        return $this;
    }

   
}
