<?php

namespace App\Repository;

use App\Entity\Papel;
use Doctrine\Persistence\ManagerRegistry;

class PapelRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Papel::class);
    }
}
