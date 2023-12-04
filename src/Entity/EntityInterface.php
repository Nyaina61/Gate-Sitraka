<?php

namespace App\Entity;

use App\Repository\EntityInterfaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntityInterfaceRepository::class)]
interface EntityInterface
{

}
