<?php

namespace App\Entity;

use App\Repository\AtendimentoRepository;
use App\Traits\Timestamps;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

#[ORM\Table(schema: 'clinica', name: 'atendimento')]
#[ORM\Entity(AtendimentoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Atendimento extends AbstractEntity 
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
    #[ORM\Column(name: 'observacoes', type:'string', nullable: true)]
    private ?string $observacoes = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'descricao', type:'string', nullable: true)]
    private ?string $descricao = null;

    /**
     * @var DateTime
     */
    #[ORM\Column(name: 'data', type:'datetime', nullable: false)]
    private DateTime $data;

    /**
     * @var Animal
     */
    #[ORM\ManyToOne(targetEntity: Animal::class, inversedBy: 'atendimentos')]
    #[ORM\JoinColumn(name: 'animal', referencedColumnName: 'id', nullable: false)]
    private Animal $animal;

    /**
     * @var Clinica
     */
    #[ORM\ManyToOne(targetEntity: Clinica::class)]
    #[ORM\JoinColumn(name: 'clinica', referencedColumnName: 'id', nullable: false)]
    private Clinica $clinica;

    /**
     * @var ProfissionalClinica
     */
    #[ORM\ManyToOne(targetEntity: ProfissionalClinica::class, inversedBy: 'atendimentos')]
    #[ORM\JoinColumn(name: 'profissional_clinica', referencedColumnName: 'id', nullable: false)]
    private ProfissionalClinica $profissionalClinica;

    /**
     * @var StatusAtendimento
     */
    #[ORM\ManyToOne(targetEntity: StatusAtendimento::class)]
    #[ORM\JoinColumn(name: 'status_atendimento', referencedColumnName: 'id', nullable: false)]
    private StatusAtendimento $statusAtendimento;

    /**
     * @var Pagamento
     */
    #[ORM\ManyToOne(targetEntity: Pagamento::class)]
    #[ORM\JoinColumn(name: 'pagamento', referencedColumnName: 'id', nullable: true)]
    private ?Pagamento $pagamento = null;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: AtendimentoVacina::class, mappedBy: 'atendimento', cascade: ['persist'])]
    private Collection $aplicacoesVacinas;

    public function __construct()
    {
        $this->aplicacoesVacinas = new ArrayCollection();
    }

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
     * @return string
     */
    public function getObservacoes(): string
    {
        return $this->observacoes;
    }

    /**
     * @param string $observacoes
     */
    public function setObservacoes(string $observacoes): self
    {
        $this->observacoes = $observacoes;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getData(): DateTime
    {
        return $this->data;
    }

    /**
     * @param DateTime $data
     */
    public function setData(DateTime $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return Animal
     */
    public function getAnimal(): Animal
    {
        return $this->animal;
    }

    /**
     * @param Animal $animal
     */
    public function setAnimal(Animal $animal): self
    {
        $this->animal = $animal;
        return $this;
    }

    /**
     * @return Clinica
     */
    public function getClinica(): Clinica
    {
        return $this->clinica;
    }

    /**
     * @param Clinica $clinica
     */
    public function setClinica(Clinica $clinica): self
    {
        $this->clinica = $clinica;
        return $this;
    }

    /**
     * @return ProfissionalClinica
     */
    public function getProfissionalClinica(): ProfissionalClinica
    {
        return $this->profissionalClinica;
    }

    /**
     * @param ProfissionalClinica profissionalClinica
     */
    public function setProfissionalClinica(ProfissionalClinica $profissionalClinica): self
    {
        $this->profissionalClinica = $profissionalClinica;
        return $this;
    }

    /**
     * @return StatusAtendimento
     */
    public function getStatusAtendimento(): StatusAtendimento
    {
        return $this->statusAtendimento;
    }

    /**
     * @param StatusAtendimento $statusAtendimento
     */
    public function setStatusAtendimento(StatusAtendimento $statusAtendimento): self
    {
        $this->statusAtendimento = $statusAtendimento;
        return $this;
    }

    /**
     * @return Pagamento
     */
    public function getPagamento(): ?Pagamento
    {
        return $this->pagamento;
    }

    /**
     * @param Pagamento $pagamento
     */
    public function setPagamento(Pagamento $pagamento): self
    {
        $this->pagamento = $pagamento;
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getAplicacoesVacinas(): Collection
    {
        return $this->aplicacoesVacinas;
    }

    public function addVacina(AtendimentoVacina $atendimentoVacina): void
    {
        $this->getAplicacoesVacinas()->add($atendimentoVacina);
    }
}