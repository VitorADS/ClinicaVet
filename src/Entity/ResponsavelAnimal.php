<?php

namespace App\Entity;

use App\Repository\ResponsavelAnimalRepository;
use App\Traits\Timestamps;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Table(schema: 'clinica', name: 'responsavel_animal')]
#[ORM\Entity(ResponsavelAnimalRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ResponsavelAnimal extends AbstractEntity
{

    use Timestamps;
    
    /**
     * @var int
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id;

    /**
     * @var Animal
     */
    #[ManyToOne(targetEntity: Animal::class)]
    #[JoinColumn(name: 'animal', referencedColumnName: 'id', nullable: false)]
    private Animal $animal;

    /**
     * @var Responsavel
     */
    #[ManyToOne(targetEntity: Responsavel::class)]
    #[JoinColumn(name: 'responsavel', referencedColumnName: 'id', nullable: false)]
    private Responsavel $responsavel;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'padrao', type:'boolean', nullable: false, options: ['default' => false])]
    private bool $padrao;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Animal
     */
    public function getAnimal(): Animal
    {
        return $this->animal;
    }

    /**
     * @param string $animal
     */
    public function setAnimal(Animal $animal): void
    {
        $this->animal = $animal;
    }

    /**
     * @return Responsavel
     */
    public function getResponsavel(): Responsavel
    {
        return $this->responsavel;
    }

    /**
     * @param Responsavel $responsavel
     */
    public function setResponsavel(Responsavel $responsavel): void
    {
        $this->responsavel = $responsavel;
    }

    /**
     * @return bool
     */
    public function getPadrao(): bool
    {
        return $this->padrao;
    }

    /**
     * @param bool $padrao
     */
    public function setPadrao(bool $padrao): void
    {
        $this->padrao = $padrao;
    }
}