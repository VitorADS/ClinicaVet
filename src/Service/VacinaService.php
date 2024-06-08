<?php

namespace App\Service;

use App\Entity\Vacina;
use Doctrine\ORM\EntityManagerInterface;

class VacinaService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Vacina::class);
    }
}