<?php

namespace App\Entity;

use App\Repository\AtendimentoVacinaRepository;
use App\Traits\Timestamps;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Table(schema: 'clinica', name: 'atendimento_vacina')]
#[ORM\Entity(AtendimentoVacinaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class AtendimentoVacina extends AbstractEntity
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
     * @var Atendimento
     */
    #[ManyToOne(targetEntity: Atendimento::class)]
    #[JoinColumn(name: 'atendimento', referencedColumnName: 'id', nullable: false)]
    private Atendimento $atendimento;

    /**
     * @var Vacina
     */
    #[ManyToOne(targetEntity: Vacina::class)]
    #[JoinColumn(name: 'vacina', referencedColumnName: 'id', nullable: false)]
    private Vacina $vacina;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Atendimento
     */
    public function getAtendimento(): Atendimento
    {
        return $this->atendimento;
    }

    /**
     * @param Atendimento $atendimento
     */
    public function setAtendimento(Atendimento $atendimento): self
    {
        $this->atendimento = $atendimento;

        return $this;
    }

    /**
     * @return Vacina
     */
    public function getVacina(): Vacina
    {
        return $this->vacina;
    }

    /**
     * @param Vacina $vacina
     */
    public function setVacina(Vacina $vacina): self
    {
        $this->vacina = $vacina;

        return $this;
    }
}