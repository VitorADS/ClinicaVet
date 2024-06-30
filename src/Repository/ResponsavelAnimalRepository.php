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

    public function insereResponsavelAnimal(array $ids, int $idAnimal, ?int $padrao = null): void
    {
        $sql = " INSERT INTO clinica.responsavel_animal (animal, responsavel, padrao) VALUES ";
        
        $lastKey = array_key_last($ids);
        foreach($ids as $key => $id){
            $definirPadrao = 'false';
            if((int) $id === $padrao){
                $definirPadrao = 'true';
            }

            if($key != $lastKey){
                $sql .= " ({$idAnimal}, {$id}, {$definirPadrao}), ";
            } else {
                $sql .= " ({$idAnimal}, {$id}, {$definirPadrao}) ";
            }
        }

        $this->getEntityManager()->beginTransaction();
        try{
            $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
            $stmt->executeQuery();

            if($padrao){
                $this->getEntityManager()->flush();
            }

            $this->getEntityManager()->commit();
        }catch(\Exception $e){
            $this->getEntityManager()->rollback();
            throw $e;
        }
    }
}