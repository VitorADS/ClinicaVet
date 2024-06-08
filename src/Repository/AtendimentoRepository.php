<?php

namespace App\Repository;

use App\Entity\Atendimento;
use Doctrine\Persistence\ManagerRegistry;

class AtendimentoRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Atendimento::class);
    }
}