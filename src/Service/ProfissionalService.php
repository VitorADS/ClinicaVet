<?php

namespace App\Service;

use App\Entity\Profissional;
use Doctrine\ORM\EntityManagerInterface;

class ProfissionalService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Profissional::class);
    }

    public function getProfissionaisCadastraveis(int $clinica): ?array
    {
        return $this->getRepository()->getProfissionaisCadastraveis($clinica);
    }
}