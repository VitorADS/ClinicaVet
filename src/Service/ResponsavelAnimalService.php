<?php

namespace App\Service;

use App\Entity\ResponsavelAnimal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class ResponsavelAnimalService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, ResponsavelAnimal::class);
    }

    public function adicionarResponsavelAnimal(array $ids, int $idAnimal): bool
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

        $this->insereResponsavelAnimal($ids, $idAnimal);
        return true;
    }

    public function insereResponsavelAnimal(array $ids, int $idAnimal): void
    {
        $this->getRepository()->insereResponsavelAnimal($ids, $idAnimal);
    }
}