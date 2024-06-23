<?php

namespace App\Entity;

use App\Repository\ProfissionalClinicaRepository;
use App\Traits\Timestamps;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(schema: 'clinica', name: 'profissional_clinica')]
#[ORM\Entity(ProfissionalClinicaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProfissionalClinica extends AbstractEntity
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
     * @var Clinica
     */
    #[ORM\ManyToOne(targetEntity: Clinica::class, inversedBy: 'profissionaisClinica')]
    #[ORM\JoinColumn(name: 'clinica', referencedColumnName: 'id', nullable: false)]
    private Clinica $clinica;

    /**
     * @var Profissional
     */
    #[ORM\ManyToOne(targetEntity: Profissional::class, inversedBy: 'profissionaisClinica')]
    #[ORM\JoinColumn(name: 'profissional', referencedColumnName: 'id', nullable: false)]
    private Profissional $profissional;

    /**
     * @var \Doctrine\ORM\PersistentCollection
     */
    #[ORM\OneToMany(targetEntity: Atendimento::class, mappedBy: 'profissionalClinica')]
    private Collection $atendimentos;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Clinica
     */
    public function getClinica(): Clinica
    {
        return $this->clinica;
    }

    /**
     * @param string $clinica
     */
    public function setClinica(Clinica $clinica): void
    {
        $this->clinica = $clinica;
    }

    /**
     * @return Profissional
     */
    public function getProfissional(): Profissional
    {
        return $this->profissional;
    }

    /**
     * @param Profissional $profissional
     */
    public function setProfissional(Profissional $profissional): void
    {
        $this->profissional = $profissional;
    }

    public function getAtendimentos(): Collection
    {
        return $this->atendimentos;
    }

    public function hasDependents(): bool
    {
        return $this->hasItems($this->getAtendimentos());
    }

    public function __tostring(): string
    {
        return $this->getProfissional()->getNome();
    }
}