<?php

namespace App\Service;

use App\Entity\AtendimentoVacina;
use Doctrine\ORM\EntityManagerInterface;

class AtendimentoVacinaService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, AtendimentoVacina::class);
    }

    public function removerAplicacao(int $idAplicacao): void
    {
        $aplicacao = $this->find($idAplicacao);

        if(!$aplicacao instanceof AtendimentoVacina){
            throw new \Exception('Aplicacao de vacina nao encontrada!');
        }

        $this->remove($aplicacao);
    }
}