<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Persistence\ManagerRegistry;

class AnimalRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }
}