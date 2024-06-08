<?php

namespace App\Repository;

use App\Entity\Pagamento;
use Doctrine\Persistence\ManagerRegistry;

class PagamentoRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pagamento::class);
    }
}