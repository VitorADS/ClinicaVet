<?php

namespace App\Service;

use App\Entity\AtendimentoVacina;
use Doctrine\ORM\EntityManagerInterface;

class AtendimentoVacinaService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, AtendimentoVacina::class);
    }
}