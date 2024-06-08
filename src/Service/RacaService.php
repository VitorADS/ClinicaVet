<?php

namespace App\Service;

use App\Entity\Raca;
use Doctrine\ORM\EntityManagerInterface;

class RacaService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Raca::class);
    }
}