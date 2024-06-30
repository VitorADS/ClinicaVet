<?php

namespace App\Repository;

use App\Entity\Vacina;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class VacinaRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacina::class);
    }

    public function getVacinas(): ?array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('v.id, v.nome');
        $qb->from($this->getEntityName(), 'v');
        
        return $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }
}