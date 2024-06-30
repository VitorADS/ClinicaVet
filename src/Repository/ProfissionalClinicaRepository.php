<?php

namespace App\Repository;

use App\Entity\ProfissionalClinica;
use Doctrine\Persistence\ManagerRegistry;

class ProfissionalClinicaRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfissionalClinica::class);
    }

    public function insereProfissionalClinica(array $ids, int $idClinica): void
    {
        $sql = " INSERT INTO clinica.profissional_clinica (clinica, profissional) VALUES ";
        
        $lastKey = array_key_last($ids);
        foreach($ids as $key => $id){
            if($key != $lastKey){
                $sql .= " ({$idClinica}, {$id}), ";
            } else {
                $sql .= " ({$idClinica}, {$id}) ";
            }
        }

        $this->getEntityManager()->beginTransaction();
        try{
            $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
            $stmt->executeStatement();
            $this->getEntityManager()->commit();
        }catch(\Exception $e){
            $this->getEntityManager()->rollback();
            throw $e;
        }
    }
}