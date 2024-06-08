<?php

namespace App\Repository;

use App\Entity\AtendimentoVacina;
use Doctrine\Persistence\ManagerRegistry;

class AtendimentoVacinaRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AtendimentoVacina::class);
    }
}