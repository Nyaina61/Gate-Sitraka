<?php

// src/Entity/Discussion.php

namespace App\Entity;

use App\Entity\MemberEntity;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\Post as PostMetadata;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use App\Controller\AddMemberToDiscussionController;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Webmozart\Assert\Assert as AssertAssert;

#[ORM\Entity()]
#[HasLifecycleCallbacks]

#[ApiResource(
    normalizationContext: [
        'groups' => ['discu_read']
    ],
    operations:[
        new PostMetadata(
            uriTemplate: '/discussions',
            controller: AddMemberToDiscussionController::class,
            deserialize: false
        ),
        new GetCollection(),
        new Get(),
        new Patch(),
        new Put(),
        new Delete()
    ]
)]
class Discussion
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['discu_read','msg_read','contact_read'])]
    public ?string $id = null;

    #[ORM\Column(type:"string", length:255,nullable:true)]
    #[Groups(['discu_read','msg_read','contact_read'])]
    private $discuName;

    #[ORM\OneToMany(targetEntity:MemberEntity::class, mappedBy:"discussion", orphanRemoval:true, cascade:["persist"])]
    #[Groups(['discu_read','users_read','msg_read','contact_read'])]
    private $members;

    #[ORM\OneToMany(mappedBy: 'discussion', targetEntity: Message::class)]
    #[Groups(['discu_read'])]
    private Collection $messages;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    // Getters and setters...

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDiscuName(): ?string
    {
        return $this->discuName;
    }

    public function setDiscuName(string $discuName): self
    {
        $this->discuName = $discuName;

        return $this;
    }

    public function addMember(MemberEntity $member)
    {
        $member->setDiscussion($this);
        $this->members[] = $member;
    }

    public function removeMember(MemberEntity $member)
    {
        $this->members->removeElement($member);
    }

    public function getMembers(): Collection
    {
        return $this->members;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setDiscussion($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getDiscussion() === $this) {
                $message->setDiscussion(null);
            }
        }

        return $this;
    }
}
