<?php

namespace App\Entity;

use App\Repository\VacinaRepository;
use App\Traits\Timestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

#[ORM\Table(schema: 'clinica', name: 'vacina')]
#[ORM\Entity(VacinaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Vacina extends AbstractEntity
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
     * @var string
     */
    #[ORM\Column(name: 'nome', type:'string', nullable: false)]
    private string $nome;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: AtendimentoVacina::class, mappedBy: 'vacina')]
    private Collection $atendimentos;

    public function __construct()
    {
        $this->atendimentos = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return PersistentCollection
     */
    public function getAtendimentos(): Collection
    {
        return $this->atendimentos;
    }
}