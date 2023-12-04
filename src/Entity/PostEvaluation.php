<?php

namespace App\Entity;
use App\Entity\Post;

use App\Entity\Evaluation;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Link;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post as PostMetadata;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity]
#[ApiResource]
#[ApiResource(
    normalizationContext: [
        'groups' => ['eval_read'],
    ],
    uriTemplate: '/posts/{id}/evaluations',
    uriVariables: [
        'id' => new Link(
            fromClass: Post::class,
            fromProperty: 'evaluations'
        )
    ], 
    operations: [
        new GetCollection()
    ]
)]
class PostEvaluation extends Evaluation
{

    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['posts_read','image_read','eval_read'])]
    private ?Post $post = null;


  public function getPost(): ?Post
  {
      return $this->post;
  }

  public function setPost(?Post $post): static
  {
      $this->post = $post;

      return $this;
  }

}