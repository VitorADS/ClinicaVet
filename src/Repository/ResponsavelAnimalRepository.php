<?php

namespace App\Repository;

use App\Entity\ResponsavelAnimal;
use Doctrine\Persistence\ManagerRegistry;

class ResponsavelAnimalRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponsavelAnimal::class);
    }

    public function insereResponsavelAnimal(array $ids, int $idAnimal): void
    {
        $sql = " INSERT INTO clinica.responsavel_animal (animal, responsavel) VALUES ";
        
        $lastKey = array_key_last($ids);
        foreach($ids as $key => $id){
            if($key != $lastKey){
                $sql .= " ({$idAnimal}, {$id}), ";
            } else {
                $sql .= " ({$idAnimal}, {$id}) ";
            }
        }

        $this->getEntityManager()->beginTransaction();
        try{
            $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
            $stmt->executeQuery();
            $this->getEntityManager()->commit();
        }catch(\Exception $e){
            $this->getEntityManager()->rollback();
            throw $e;
        }
    }
}