<?php

namespace App\Repository;

use App\Entity\Responsavel;
use Doctrine\Persistence\ManagerRegistry;

class ResponsavelRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Responsavel::class);
    }

}