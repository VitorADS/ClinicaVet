<?php

namespace App\Service;

use App\Entity\Animal;
use Doctrine\ORM\EntityManagerInterface;

class AnimalService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Animal::class);
    }

    public function getResponsaveisCadastraveis(int $id): ?array
    {
        return $this->getRepository()->getResponsaveisCadastraveis($id);
    }
}