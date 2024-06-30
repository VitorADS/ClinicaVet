<?php

namespace App\Service;

use App\Entity\AbstractEntity;
use App\Entity\Profissional;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfissionalService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $hasher
    )
    {
        parent::__construct($entityManager, Profissional::class);
    }

    public function getProfissionaisCadastraveis(int $clinica): ?array
    {
        return $this->getRepository()->getProfissionaisCadastraveis($clinica);
    }

    /**
     * @param Profissional $entity,
     * @param ?int $id = null
     * @return Profissional
     */
    public function save(AbstractEntity $entity, ?int $id = null): AbstractEntity
    {
        $entity->setPassword($this->hasher->hashPassword($entity, $entity->getPassword()));
        return parent::save($entity, $id);
    }
}