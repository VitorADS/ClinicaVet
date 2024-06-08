<?php

namespace App\Repository;

use App\Entity\ProfissionalClinica;
use Doctrine\Persistence\ManagerRegistry;

class ProfissionalClinicaRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfissionalClinica::class);
    }
}