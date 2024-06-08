<?php

namespace App\Service;

use App\Entity\ProfissionalClinica;
use Doctrine\ORM\EntityManagerInterface;

class ProfissionalClinicaService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, ProfissionalClinica::class);
    }
}