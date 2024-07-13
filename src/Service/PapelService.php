<?php

namespace App\Service;

use App\Entity\Papel;
use Doctrine\ORM\EntityManagerInterface;

class PapelService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Papel::class);
    }
}