<?php

namespace App\Entity;

use App\Entity\Author;
use App\Entiy\SenderEntity;
use ApiPlatform\Metadata\Get;
use App\Entity\ProfilePicture;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\UserCustomController;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['users_read']
    ],
)]
#[UniqueEntity('email', message: 'Cette adresse email est déjà utilisé')]
class User extends Author implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank([
        'message' => 'Veillez entrer votre adresse email !'
    ])]
    #[Assert\Email(
        message: '{{ value }} n\'est pas une adresse email valide !',
    )]
    #[Groups(['users_read','discu_read','contact_read','eval_read'])]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(nullable:true)]
    #[Assert\NotBlank([
        'message' => 'Veillez entrer un mot de passe !'
    ])]
    #[Assert\Regex('/^(?=.*[a-z])(?=.*[A-Z]).{6,}$/', message: 'Le mot de passe est invalide !')]
    private ?string $password = null;

    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank([
        'message' => 'Veillez entrer votre nom !'
    ])]
    #[Groups(['users_read', 'posts_read','image_read','discu_read','msg_read','contact_read','invest_read','eval_read','author_read','comment_read','reply_read'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['users_read', 'posts_read','image_read','discu_read','msg_read','contact_read','invest_read','eval_read','author_read','comment_read','reply_read'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255,nullable:true)]
    #[Assert\Date(message: 'Veillez entrer une date valide !')]
    #[Assert\NotBlank([
        'message' => 'Veillez entrer votre date de naissance !'
    ])]
    #[Groups(['users_read', 'posts_read'])]
    private ?string $birthDate = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['users_read', 'posts_read'])]
    private ?Gender $gender = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ProfilePicture::class, orphanRemoval: true)]
    #[Groups(['image_read','discu_read','msg_read'])]
    private Collection $profilePictures;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['users_read', 'posts_read','image_read','discu_read','msg_read','invest_read','comment_read','author_read','profile_pic_read','reply_read'])]
    private ?ProfilePicture $activeProfilePicture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $googleId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fbId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $linkedInId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagramId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $microsoftId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $discordId = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Recommended::class)]
    #[Groups(['users_read', 'posts_read'])]
    private Collection $recommended;

    #[ORM\ManyToMany(targetEntity: Domain::class, inversedBy: 'users')]
    #[Groups(['users_read', 'posts_read'])]
    private Collection $domains;

    public function getId(): ?string
    {
        return parent::getId();
    }

    public function __construct()
    {
        $this->profilePictures = new ArrayCollection();
        $this->recommended = new ArrayCollection();
        $this->domains = new ArrayCollection();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, ProfilePicture>
     */
    public function getProfilePictures(): Collection
    {
        return $this->profilePictures;
    }

    public function addProfilePicture(ProfilePicture $profilePicture): static
    {
        if (!$this->profilePictures->contains($profilePicture)) {
            $this->profilePictures->add($profilePicture);
            $profilePicture->setUser($this);
        }

        return $this;
    }

    public function removeProfilePicture(ProfilePicture $profilePicture): static
    {
        if ($this->profilePictures->removeElement($profilePicture)) {
            // set the owning side to null (unless already changed)
            if ($profilePicture->getUser() === $this) {
                $profilePicture->setUser(null);
            }
        }

        return $this;
    }

    public function getActiveProfilePicture(): ?ProfilePicture
    {
        return $this->activeProfilePicture;
    }

    public function setActiveProfilePicture(?ProfilePicture $activeProfilePicture): static
    {
        $this->activeProfilePicture = $activeProfilePicture;

        return $this;
    }

    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    public function setGoogleId(?string $googleId): static
    {
        $this->googleId = $googleId;

        return $this;
    }

    public function getFbId(): ?string
    {
        return $this->fbId;
    }

    public function setFbId(?string $fbId): static
    {
        $this->fbId = $fbId;

        return $this;
    }

    public function getLinkedInId(): ?string
    {
        return $this->linkedInId;
    }

    public function setLinkedInId(?string $linkedInId): static
    {
        $this->linkedInId = $linkedInId;

        return $this;
    }

    public function getInstagramId(): ?string
    {
        return $this->instagramId;
    }

    public function setInstagramId(?string $instagramId): static
    {
        $this->instagramId = $instagramId;

        return $this;
    }

    public function getMicrosoftId(): ?string
    {
        return $this->microsoftId;
    }

    public function setMicrosoftId(?string $microsoftId): static
    {
        $this->microsoftId = $microsoftId;

        return $this;
    }

    public function getDiscordId(): ?string
    {
        return $this->discordId;
    }

    public function setDiscordId(?string $discordId): static
    {
        $this->discordId = $discordId;

        return $this;
    }

    /**
     * @return Collection<int, Recommended>
     */
    public function getRecommended(): Collection
    {
        return $this->recommended;
    }

    public function addRecommended(Recommended $recommended): static
    {
        if (!$this->recommended->contains($recommended)) {
            $this->recommended->add($recommended);
            $recommended->setUser($this);
        }

        return $this;
    }

    public function removeRecommended(Recommended $recommended): static
    {
        if ($this->recommended->removeElement($recommended)) {
            // set the owning side to null (unless already changed)
            if ($recommended->getUser() === $this) {
                $recommended->setUser(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Domain>
     */
    public function getDomains(): Collection
    {
        return $this->domains;
    }

    public function addDomain(Domain $domain): static
    {
        if (!$this->domains->contains($domain)) {
            $this->domains->add($domain);
        }

        return $this;
    }

    public function removeDomain(Domain $domain): static
    {
        $this->domains->removeElement($domain);

        return $this;
    }
    
}
