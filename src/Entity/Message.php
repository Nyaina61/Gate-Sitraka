<?php

namespace App\Entity;

use App\Entity\Discussion;
use ApiPlatform\Metadata\Get;
use PhpParser\Node\Attribute;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post as PostMetadata;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
#[ApiResource(
    normalizationContext: [
        'groups' => ['msg_read']
    ],
    order: ["createdAt" => "DESC"]
)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['msg_read']
    ],
    order:["createdAt"=>"DESC"],
    uriTemplate: '/discussions/{id}/messages', 
    uriVariables: [
        'id' => new Link(
            fromClass: Discussion::class,
            fromProperty: 'messages'
        )
    ], 
    operations: [
        new GetCollection(),
        new PostMetadata()
    ]
)]
#[ORM\Entity]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(['users_read','discu_read','msg_read'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Author::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['posts_read','discu_read','msg_read'])]
    private ?Author $author = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['users_read','discu_read','msg_read'])]
    private ?string $content = null;

    #[ORM\Column]
    #[Groups(['users_read','discu_read','msg_read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['users_read','discu_read','msg_read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[Groups(['users_read','discu_read','msg_read'])]
    private ?Discussion $discussion = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDiscussion(): ?Discussion
    {
        return $this->discussion;
    }

    public function setDiscussion(?Discussion $discussion): static
    {
        $this->discussion = $discussion;

        return $this;
    }
}
