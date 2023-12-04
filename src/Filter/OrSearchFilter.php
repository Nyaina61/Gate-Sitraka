<?php

namespace App\Filter;

use App\Entity\Company;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;

class OrSearchFilter extends AbstractFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operationName = null, array $context = []): void
    {

        if ($property !== 'or' || !is_array($value)) {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];
        $orX = $queryBuilder->expr()->orX();

        foreach ($value as $k => $v) {
            $orX->add($queryBuilder->expr()->like($alias . '.' . $k, ':param_' . $k));
            $queryBuilder->setParameter('param_' . $k, '%' . $v . '%');
        }

        $queryBuilder->andWhere($orX);
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'or' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
            ]
        ];
    }

}