<?php

namespace App\Service;

use App\Entity\StatusAtendimento;
use Doctrine\ORM\EntityManagerInterface;

class StatusAtendimentoService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, StatusAtendimento::class);
    }
}