<?php

namespace App\Filter;

use App\Entity\Company;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;

class CompanyTypeTitleFilter extends AbstractFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operationName = null,array $context = []): void
    {
        
        if ($property !== 'companyTypeTitles') {
            return;
        }

        if (!is_array($value)) {
            throw new \InvalidArgumentException('Expected an array');
        }

        $alias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->leftJoin(sprintf('%s.author', $alias),'a');
        $queryBuilder->leftJoin(sprintf(Company::class, $alias),'c','WITH','a.id=c.id');
        $queryBuilder->leftJoin(sprintf('c.companyType', $alias),'ct');
        $queryBuilder->andWhere(sprintf('ct.type IN (:companyTypeTitles)', $alias));
        $queryBuilder->setParameter('companyTypeTitles', $value);
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'companyTypeTitles' => [
                'property' => null,
                'type' => 'array',
                'required' => false,
            ]
        ];
    }

}