<?php

namespace App\Entity;

use ApiPlatform\Metadata\Link;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\CommentableEntity;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommentRepository;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\CustomCommentController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\Post as MetadataPost;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ApiResource(
    normalizationContext:['groups'=>'comment_read'],
)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['reply_read']
    ],
    order:["createdAt"=>"DESC"],
    uriTemplate: '/comments/{id}/replies', 
    uriVariables: [
        'id' => new Link(
            fromClass: self::class,
            fromProperty: 'replies'
        )
    ], 
    operations: [
        new GetCollection(),
    ]
)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['comment_read']
    ],
    order:["createdAt"=>"DESC"],
    uriTemplate: '/commentable_entities/{id}/comments', 
    uriVariables: [
        'id' => new Link(
            fromClass: CommentableEntity::class,
            fromProperty: 'comments'
        )
    ], 
    operations: [
        new GetCollection(),
    ]
)]
#[ApiFilter(ExistsFilter::class, properties: ['parent'])]
class Comment
{
    #[ORM\Id]
    #[ORM\Column(type:"string", unique:true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['posts_read','comment_read','reply_read','reply2_read'])]
    private ?string $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['posts_read','image_read','comment_read','reply_read'])]
    private ?string $content = null;

    #[ORM\Column]
    #[Groups(['posts_read','image_read','comment_read','reply_read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(targetEntity:Author::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['posts_read','image_read','comment_read','author_read','reply_read'])]
    private ?Author $author = null;


    #[ORM\ManyToOne(targetEntity:CommentableEntity::class)]
    private $commentable;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'replies')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $replies;

    

    

    

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->replies = new ArrayCollection();
        $this->commentReplies = new ArrayCollection();
    }

    #[ORM\PreUpdate]
    public function preUpdate()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PrePersist]
    public function PrePersist()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getCommentable(): ?CommentableEntity
    {
        return $this->commentable;
    }

    public function setCommentable(?CommentableEntity $commentable): static
    {
        $this->commentable = $commentable;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(self $reply): static
    {
        if (!$this->replies->contains($reply)) {
            $this->replies->add($reply);
            $reply->setParent($this);
        }

        return $this;
    }

    public function removeReply(self $reply): static
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getParent() === $this) {
                $reply->setParent(null);
            }
        }

        return $this;
    }

    

    
}
