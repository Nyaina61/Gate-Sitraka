<?php

namespace App\Entity;

use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post as MetadataPost;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\PostEvaluation;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\EvaluationController;
use App\Repository\EvaluationRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"evaluation_type", type:"string")]
#[ORM\DiscriminatorMap(["postEvaluation" => PostEvaluation::class])]
#[ApiResource(
    normalizationContext: [
        'groups' => ['eval_read'],
    ],
    operations: [
        new Get(),
        new GetCollection(),
        new Put(),
        new Patch(),
        new MetadataPost(
            uriTemplate: '/evaluations', 
            controller: EvaluationController::class,
            deserialize: false
        ),
    ]
)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['posts_read','eval_read'])]
    private ?int $id = null;

    #[ORM\Column(nullable: false)]
    #[Groups(['posts_read','eval_read'])]
    private ?int $note = null;

    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['posts_read','eval_read'])]
    private ?Author $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

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

}
