<?php

namespace App\Repository;

use App\Entity\ResponsavelAnimal;
use Doctrine\Persistence\ManagerRegistry;

class ResponsavelAnimalRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponsavelAnimal::class);
    }
}