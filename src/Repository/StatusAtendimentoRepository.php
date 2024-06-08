<?php

namespace App\Repository;

use App\Entity\StatusAtendimento;
use Doctrine\Persistence\ManagerRegistry;

class StatusAtendimentoRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusAtendimento::class);
    }
}