<?php

namespace App\Service;

use App\Entity\AbstractEntity;
use App\Entity\ProfissionalClinica;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class ProfissionalClinicaService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, ProfissionalClinica::class);
    }

    public function adicionarProfissionalClinica(array $ids, int $idClinica): bool
    {
        $constraint = new Assert\All([
            'constraints' => [
                new Assert\Type([
                    'type' => 'numeric',
                    'message'=> 'O ID {{ value }} nao eh valido'
                ]),
                new Assert\Positive([
                    'message' => 'O ID {{ value }} nao eh valido'
                ])
            ]
        ]);
        $validator = Validation::createValidator();
        $violations = $validator->validate($ids, $constraint);

        if($violations->count() > 0){
            $error = '- ';

            foreach($violations as $violation){
                $error .= $violation->getMessage() . ' - ';
            }

            throw new \Exception($error);
        }

        $this->insereProfissionalClinica($ids, $idClinica);
        return true;
    }

    public function insereProfissionalClinica(array $ids, int $idClinica): void
    {
        $this->getRepository()->insereProfissionalClinica($ids, $idClinica);
    }
}