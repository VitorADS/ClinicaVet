<?php

namespace App\Service;

use App\Entity\AbstractEntity;
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

    /**
     * @param Vacina $entity
     */
    public function save(AbstractEntity $entity, ?int $id = null): AbstractEntity
    {
        if(!$entity->getAtendimentos()->isEmpty()){
            throw new \Exception('Vacina possui atendimentos vinculados!');
        }

        return parent::save($entity, $id);
    }
    
    public function getVacinas(): ?array
    {
        return $this->getRepository()->getVacinas();
    }
}