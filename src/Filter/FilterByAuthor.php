<?php

namespace App\Filter;

use App\Entity\Company;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;

class FilterByAuthor extends AbstractFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operationName = null, array $context = []): void
    {
        $propertyToArray = explode('.', $property);
        if (!(count($propertyToArray) === 2)) {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->leftJoin(sprintf('%s.author', $alias), 'a');
        $queryBuilder->leftJoin(sprintf("App\Entity\\" . ucfirst($propertyToArray[0]), $alias), $propertyToArray[0], 'WITH', "a.id={$propertyToArray[0]}.id");

        $queryBuilder->andWhere("{$propertyToArray[0]}.{$propertyToArray[1]} LIKE :val");
        $queryBuilder->setParameter('val', '%' . $value . '%');
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'filterByAuthor' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
            ]
        ];
    }

}