<?php

namespace App\Entity;


use App\Entity\Post;
use App\Entity\Image;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AuthorRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use App\Repository\CommentableEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentableEntityRepository::class)]
#[ApiResource]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"commentable_type", type:"string")]
#[ORM\DiscriminatorMap(["post" => Post::class,"image"=>Image::class])]
abstract class CommentableEntity
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['posts_read','image_read','eval_read'])]
    public ?string $id = null;

    #[ORM\OneToMany(mappedBy: 'commentable', targetEntity: Comment::class, orphanRemoval: true)]
    #[Groups(['posts_read','image_read'])]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    // Ajoutez ici les propriétés et méthodes communes à tous les auteurs
    // ...

    private function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCommentable($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCommentable() === $this) {
                $comment->setCommentable(null);
            }
        }

        return $this;
    }

   
}

