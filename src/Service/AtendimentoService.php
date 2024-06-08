<?php

namespace App\Service;

use App\Entity\Atendimento;
use Doctrine\ORM\EntityManagerInterface;

class AtendimentoService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Atendimento::class);
    }
}