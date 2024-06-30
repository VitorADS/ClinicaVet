<?php

namespace App\Service;

use App\Entity\AbstractEntity;
use App\Entity\Animal;
use App\Entity\ResponsavelAnimal;
use Doctrine\ORM\EntityManagerInterface;

class AnimalService extends AbstractService
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, Animal::class);
    }

    public function getResponsaveisCadastraveis(int $id): ?array
    {
        return $this->getRepository()->getResponsaveisCadastraveis($id);
    }

    public function defineResponsavel(int $idResponsavelAnimal, Animal $animal, ResponsavelAnimalService $responsavelAnimalService): void
    {
        /** @var ResponsavelAnimal $responsavelAnimal */
        $responsavelAnimal = $responsavelAnimalService->find($idResponsavelAnimal);

        if(!$responsavelAnimal instanceof ResponsavelAnimal){
            throw new \Exception('Responsavel nao encontrado');
        }

        if(!$animal->verificaResponsavel($idResponsavelAnimal)){
            throw new \Exception('Responsavel nao encontrado');
        }

        if($animal->getResponsavelPadrao()){
            $animal->getResponsavelPadrao()->setPadrao(false);
        }
        $responsavelAnimal->setPadrao(true);

        $this->getEntityManager()->flush();
    }

    /**
     * @param Animal $entity
     */
    public function remove(AbstractEntity $entity): bool
    {
        if(!$entity->getAtendimentos()->isEmpty()){
            throw new \Exception('Nao e possivel excluir animal com atendimentos!');
        }

        return parent::remove($entity);
    }
}