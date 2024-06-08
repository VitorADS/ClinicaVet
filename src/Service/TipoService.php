<?php

namespace App\Service;

use App\Entity\Tipo;
use Doctrine\ORM\EntityManagerInterface;

class TipoService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Tipo::class);
    }
}