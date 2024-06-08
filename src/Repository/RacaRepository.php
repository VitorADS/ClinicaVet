<?php

namespace App\Repository;

use App\Entity\Raca;
use Doctrine\Persistence\ManagerRegistry;

class RacaRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Raca::class);
    }
}