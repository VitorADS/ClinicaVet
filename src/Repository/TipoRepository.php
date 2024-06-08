<?php

namespace App\Repository;

use App\Entity\Tipo;
use Doctrine\Persistence\ManagerRegistry;

class TipoRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tipo::class);
    }
}