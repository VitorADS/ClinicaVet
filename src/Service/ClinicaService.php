<?php

namespace App\Service;

use App\Entity\Clinica;
use Doctrine\ORM\EntityManagerInterface;

class ClinicaService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Clinica::class);
    }
}