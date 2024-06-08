<?php

namespace App\Repository;

use App\Entity\Clinica;
use Doctrine\Persistence\ManagerRegistry;

class ClinicaRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clinica::class);
    }
}