<?php

namespace App\Doctrine;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Image;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Message;
use App\Entity\Thumbnail;
use App\Entity\Discussion;
use Doctrine\ORM\QueryBuilder;
use App\Entity\CommentRelation;
use PhpParser\Node\Stmt\Switch_;
use Doctrine\ORM\Query\Expr\Join;
use App\Entity\AuthorTypeRelation;
use ApiPlatform\Metadata\Operation;
use Symfony\Bundle\SecurityBundle\Security;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;

class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{

    public function __construct(private Security $security)
    {
    }

    public function ensureMine(QueryBuilder $queryBuilder, string $resourceClass)
    {
        $user = $this->security->getUser();

        if ($resourceClass === Discussion::class) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->innerJoin("$rootAlias.members", 'm')
                ->andWhere('m.user = :user')
                ->setParameter('user', $user);
        }
        if ($resourceClass === Contact::class) {
            $queryBuilder->andWhere('o.requester=:user OR o.receiver=:user')
                ->setParameter('user', $user);
        }
    }

    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        ?Operation $operation = null,
        array $context = []
    ): void {
        // dd($resourceClass);
        if($operation->getMethod()==="GET"){
            $this->ensureMine($queryBuilder, $resourceClass);
        }
    }

    public function applyToItem(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        array $identifiers,
        ?Operation $operation = null,
        array $context = []
    ): void {
        if($operation->getMethod()==="GET"){
            $this->ensureMine($queryBuilder, $resourceClass);
        }
        
    }
}
