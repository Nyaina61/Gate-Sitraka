<?php

namespace App\Doctrine;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryResultItemExtensionInterface;
use ApiPlatform\Metadata\Operation;

class CustomItemExtension implements QueryResultItemExtensionInterface
{
    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, ?Operation $operation = null, array $context = []): void
    {
        dd('ntay');
    }
    
    public function supportsResult(string $resourceClass, ?Operation $operation = null, array $context = []): bool
    {
        return true;
    }

    public function getResult(QueryBuilder $queryBuilder, ?string $resourceClass = null, ?Operation $operation = null, array $context = []): ?object
    {
        return $queryBuilder;
    }
}