<?php

namespace App\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Symfony\Component\Uid\Uuid;



class Base58UuidGenerator extends AbstractIdGenerator{
    public function generate(EntityManager $em, $entity)
    {
        $base58Uuid=Uuid::v4()->toBase58();
        return $base58Uuid;
    }
}