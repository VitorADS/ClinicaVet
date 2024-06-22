<?php

namespace App\Repository;

use App\Entity\Clinica;
use App\Entity\Profissional;
use App\Entity\ProfissionalClinica;
use Doctrine\Persistence\ManagerRegistry;

class ProfissionalRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profissional::class);
    }

    public function getProfissionaisCadastraveis(int $clinica): ?array
    {
        $subConsulta = $this->getEntityManager()->createQueryBuilder();
        $subConsulta->select('pc');
        $subConsulta->from(ProfissionalClinica::class, 'pc');
        $subConsulta->where('pc.clinica = :clinica');
        $subConsulta->andWhere('pc.profissional = p.id');

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('p');
        $queryBuilder->from($this->getEntityName(), 'p');
        $queryBuilder->where($queryBuilder->expr()->not($queryBuilder->expr()->exists($subConsulta->getDQL())));
        $queryBuilder->setParameter('clinica', $clinica);

        return $queryBuilder->getQuery()->getResult();
    }
}