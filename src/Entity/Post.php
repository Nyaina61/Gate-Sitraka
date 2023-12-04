<?php

namespace App\Entity;

use App\Entity\Author;
use App\Entity\Thumbnail;
use App\Entity\Evaluation;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use App\Entity\PostEvaluation;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\PostController;
use App\Repository\PostRepository;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\GetPostController;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use App\Controller\PostThumbUploadController;
use ApiPlatform\Metadata\Post as MetadataPost;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(

    normalizationContext: [
        'groups' => ['posts_read'],
    ],
    operations: [
        new Get(
            // controller: GetPostController::class,
            // deserialize: false
        ),
        new GetCollection(
            // controller: GetPostController::class,
            // deserialize: false
        ),
        new Put(
        ),
        new Patch(
        ),
        new Delete(),
        new MetadataPost(
            uriTemplate: '/posts/{id}/update',
            controller: PostController::class,
            deserialize: false
        ),
        new MetadataPost(
            controller: PostController::class,
            deserialize: false
        ),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['content' => 'exact'])]
class Post extends CommentableEntity
{


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['posts_read','eval_read'])]
    private ?string $content = null;

    #[ORM\Column]
    #[Groups(['posts_read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Thumbnail::class, cascade: ["persist"], orphanRemoval: true)]
    #[Groups(['posts_read'])]
    private Collection $thumbnails;

    #[ORM\ManyToOne(targetEntity: Author::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['posts_read'])]
    private ?Author $author = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: PostEvaluation::class, orphanRemoval: true)]
    #[Groups(['posts_read'])]
    private Collection $evaluations;

   
    

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->thumbnails = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
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

    /**
     * @return Collection<int, Thumbnail>
     */
    public function getThumbnails(): Collection
    {
        return $this->thumbnails;
    }

    public function addThumbnail(Thumbnail $thumbnail): static
    {
        if (!$this->thumbnails->contains($thumbnail)) {
            $this->thumbnails->add($thumbnail);
            $thumbnail->setPost($this);
        }

        return $this;
    }

    public function removeThumbnail(Thumbnail $thumbnail): static
    {
        if ($this->thumbnails->removeElement($thumbnail)) {
            // set the owning side to null (unless already changed)
            if ($thumbnail->getPost() === $this) {
                $thumbnail->setPost(null);
            }
        }

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

    /**
     * @return Collection<int, PostEvaluation>
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(PostEvaluation $evaluation): static
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations->add($evaluation);
            $evaluation->setPost($this);
        }

        return $this;
    }

    public function removeEvaluation(PostEvaluation $evaluation): static
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getPost() === $this) {
                $evaluation->setPost(null);
            }
        }

        return $this;
    }



    
}
