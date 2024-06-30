<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use App\Traits\Timestamps;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

#[ORM\Table(schema: 'clinica', name: 'animal')]
#[ORM\Entity(AnimalRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Animal extends AbstractEntity
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
     * @var string
     */
    #[ORM\Column(name: 'cor', type:'string', nullable: false)]
    private string $cor;

    /**
     * @var float
     */
    #[ORM\Column(name: 'peso', type:'float', nullable: false)]
    private float $peso;

    /**
     * @var float
     */
    #[ORM\Column(name: 'altura', type:'float', nullable: false)]
    private float $altura;

    /**
     * @var DateTime
     */
    #[ORM\Column(name: 'data_nascimento', type:'date', nullable: false)]
    private DateTime $dataNascimento;

    /**
     * @var Tipo
     */
    #[ORM\ManyToOne(targetEntity: Tipo::class)]
    #[ORM\JoinColumn(name: 'tipo', referencedColumnName: 'id', nullable: false)]
    private Tipo $tipo;

    /**
     * @var Raca
     */
    #[ORM\ManyToOne(targetEntity: Raca::class)]
    #[ORM\JoinColumn(name: 'raca', referencedColumnName: 'id', nullable: true)]
    private ?Raca $raca = null;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: ResponsavelAnimal::class, mappedBy: 'animal')]
    private Collection $responsaveis;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: Atendimento::class, mappedBy: 'animal')]
    private Collection $atendimentos;

    public function __construct()
    {
        $this->responsaveis = new ArrayCollection();
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
     * @return string
     */
    public function getCor(): string
    {
        return $this->cor;
    }

    /**
     * @param string $cor
     */
    public function setCor(string $cor): void
    {
        $this->cor = $cor;
    }

    /**
     * @return float
     */
    public function getPeso(): string
    {
        return $this->peso;
    }

    /**
     * @param float $peso
     */
    public function setPeso(float $peso): void
    {
        $this->peso = $peso;
    }

    /**
     * @return float
     */
    public function getAltura(): float
    {
        return $this->altura;
    }

    /**
     * @param float $altura
     */
    public function setAltura(float $altura): void
    {
        $this->altura = $altura;
    }

    /**
     * @return DateTime
     */
    public function getDataNascimento(): DateTime
    {
        return $this->dataNascimento;
    }

    /**
     * @param DateTime $dataNascimento
     */
    public function setDataNascimento(DateTime $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    /**
     * @return Tipo
     */
    public function getTipo(): Tipo
    {
        return $this->tipo;
    }

    /**
     * @param Tipo $tipo
     */
    public function setTipo(Tipo $tipo): void
    {
        $this->tipo = $tipo;
    }

    /**
     * @return Raca
     */
    public function getRaca(): ?Raca
    {
        return $this->raca;
    }

    /**
     * @param Raca $raca
     */
    public function setRaca(?Raca $raca = null): void
    {
        $this->raca = $raca;
    }

    public function getIdade(): string
    {
        return $this->getDataNascimento()->diff(new DateTime())->format('%y anos, %m meses e %d dias');
    }

    /**
     * @return PersistentCollection
     */
    public function getResponsaveis(): Collection
    {
        return $this->responsaveis;
    }

    /**
     * @return PersistentCollection
     */
    public function getAtendimentos(): Collection
    {
        return $this->atendimentos;
    }

    public function getResponsavelPadrao(): ?ResponsavelAnimal
    {
        $criteria = Criteria::create();
        $criteria->where($criteria->expr()->eq('padrao', true));
        $result = $this->getResponsaveis()->matching($criteria);

        return $result->count() === 1 ? $result->first() : null;
    }
}