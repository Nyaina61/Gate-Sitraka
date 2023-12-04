<?php

namespace App\Filter;

use App\Entity\Company;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;

class CompanySizeFilter extends AbstractFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operationName = null,array $context = []): void
    {
        
        if ($property !== 'companySizes') {
            return;
        }

        if (!is_array($value)) {
            throw new \InvalidArgumentException('Expected an array');
        }
        $alias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->leftJoin(sprintf('%s.author', $alias),'a1');
        $queryBuilder->leftJoin(sprintf(Company::class, $alias),'c1','WITH','a1.id=c1.id');
        $queryBuilder->leftJoin(sprintf('c1.companySize', $alias),'cs1');
        $queryBuilder->andWhere(sprintf('cs1.id IN (:companySizes)', $alias));
        $queryBuilder->setParameter('companySizes', $value);
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'companySizeTitles' => [
                'property' => null,
                'type' => 'array',
                'required' => false,
            ]
        ];
    }

}