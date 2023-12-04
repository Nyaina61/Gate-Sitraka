<?php

 namespace App\Filter;

 use Doctrine\ORM\QueryBuilder;
 use ApiPlatform\Metadata\Operation;
 use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
 use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;

 class HotelFilter extends AbstractFilter
 {
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operationName = null,array $context = []): void
    {
        if ($property === 'location' && $value !== null) {
            $queryBuilder->andWhere('o.location = :destination');
            $queryBuilder->setParameter('destination', $value);
        }

        if ($property === 'arrive' && $value !== null) {
            $queryBuilder->andWhere('o.arrive >= :arrive');
            $queryBuilder->setParameter('arrive', $value);
        }

        if ($property === 'depart' && $value !== null) {
            $queryBuilder->andWhere('o.depart <= :depart');
            $queryBuilder->setParameter('depart', $value);
        }

    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'destination' => [
               'property' => null,
               'type' => 'string',
               'required' => false,
            ],
            'arrive' => [
               'property' => null,
               'type' => 'datetime',
               'required' => false,
            ],
            'depart' => [
               'property' => null,
               'type' => 'datetime',
               'required' => false,
            ],

        ];
    }
 }
