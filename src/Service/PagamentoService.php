<?php

namespace App\Service;

use App\Entity\Pagamento;
use Doctrine\ORM\EntityManagerInterface;

class PagamentoService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Pagamento::class);
    }
}