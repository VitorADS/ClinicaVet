<?php

namespace App\Repository;

use App\Entity\Vacina;
use Doctrine\Persistence\ManagerRegistry;

class VacinaRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacina::class);
    }
}