<?php

namespace App\Service;

use App\Entity\Responsavel;
use Doctrine\ORM\EntityManagerInterface;

class ResponsavelService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Responsavel::class);
    }
}