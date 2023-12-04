<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use App\Repository\AboutRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
#[ApiResource(
    normalizationContext:[
        'groups' => ['users_read', 'about_read']
    ]
)]
class About
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[Column(type: 'json')]
    #[Groups(['pays_read','aside_read'])]
    private array $extraData = [];

    #[ORM\OneToMany(mappedBy: 'about', targetEntity: UserCertificationsLicences::class)]
    #[Groups(['users_read', 'about_read'])]
    private Collection $certifificationsLicences;

    #[ORM\OneToMany(mappedBy: 'about', targetEntity: UserEducation::class)]
    #[Groups(['users_read', 'about_read'])]
    private Collection $educations;

    #[ORM\OneToMany(mappedBy: 'about', targetEntity: UserExperience::class)]
    #[Groups(['users_read', 'about_read'])]
    private Collection $experiences;

    #[ORM\OneToMany(mappedBy: 'about', targetEntity: UserSkills::class)]
    #[Groups(['users_read', 'about_read'])]
    private Collection $skills;

    #[ORM\ManyToOne(inversedBy: 'about')]
    private ?User $user = null;

    public function __construct()
    {
        $this->certifificationsLicences = new ArrayCollection();
        $this->educations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->skills = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return Collection<int, UserCertificationsLicences>
     */
    public function getCertifificationsLicences(): Collection
    {
        return $this->certifificationsLicences;
    }

    public function addCertifificationsLicence(UserCertificationsLicences $certifificationsLicence): static
    {
        if (!$this->certifificationsLicences->contains($certifificationsLicence)) {
            $this->certifificationsLicences->add($certifificationsLicence);
            $certifificationsLicence->setAbout($this);
        }

        return $this;
    }

    public function removeCertifificationsLicence(UserCertificationsLicences $certifificationsLicence): static
    {
        if ($this->certifificationsLicences->removeElement($certifificationsLicence)) {
            // set the owning side to null (unless already changed)
            if ($certifificationsLicence->getAbout() === $this) {
                $certifificationsLicence->setAbout(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserEducation>
     */
    public function getEducations(): Collection
    {
        return $this->educations;
    }

    public function addEducation(UserEducation $education): static
    {
        if (!$this->educations->contains($education)) {
            $this->educations->add($education);
            $education->setAbout($this);
        }

        return $this;
    }

    public function removeEducation(UserEducation $education): static
    {
        if ($this->educations->removeElement($education)) {
            // set the owning side to null (unless already changed)
            if ($education->getAbout() === $this) {
                $education->setAbout(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserExperience>
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(UserExperience $experience): static
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences->add($experience);
            $experience->setAbout($this);
        }

        return $this;
    }

    public function removeExperience(UserExperience $experience): static
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getAbout() === $this) {
                $experience->setAbout(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserSkills>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(UserSkills $skill): static
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
            $skill->setAbout($this);
        }

        return $this;
    }

    public function removeSkill(UserSkills $skill): static
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getAbout() === $this) {
                $skill->setAbout(null);
            }
        }

        return $this;
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
     * Get the value of extraData
     */ 
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * Set the value of extraData
     *
     * @return  self
     */ 
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;

        return $this;
    }
}
