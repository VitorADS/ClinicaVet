<?php

namespace App\Service;

use App\Entity\ResponsavelAnimal;
use Doctrine\ORM\EntityManagerInterface;

class ResponsavelAnimalService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, ResponsavelAnimal::class);
    }
}