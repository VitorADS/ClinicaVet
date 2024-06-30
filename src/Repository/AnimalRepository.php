<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\Responsavel;
use App\Entity\ResponsavelAnimal;
use Doctrine\Persistence\ManagerRegistry;

class AnimalRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    public function getResponsaveisCadastraveis(int $id): ?array
    {
        $subConsulta = $this->getEntityManager()->createQueryBuilder();
        $subConsulta->select('ra');
        $subConsulta->from(ResponsavelAnimal::class, 'ra');
        $subConsulta->where('ra.animal = :animal');
        $subConsulta->andWhere('ra.responsavel = r.id');

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('r');
        $queryBuilder->from(Responsavel::class, 'r');
        $queryBuilder->where($queryBuilder->expr()->not($queryBuilder->expr()->exists($subConsulta->getDQL())));
        $queryBuilder->setParameter('animal', $id);

        return $queryBuilder->getQuery()->getResult();
    }
}