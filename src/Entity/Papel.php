<?php

namespace App\Entity;

use App\Repository\PapelRepository;
use App\Traits\Timestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(schema: 'clinica', name: 'papel')]
#[ORM\Entity(PapelRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Papel extends AbstractEntity
{
    use Timestamps;

    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $nome;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $periodoInicial;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $periodoFinal;

    #[ORM\Column(name: 'ativo', type:'boolean', nullable: false, options: ['default' => true])]
    private bool $ativo = true;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var Collection<int, Profissional>
     */
    #[ORM\ManyToMany(targetEntity: Profissional::class, inversedBy: 'papeis')]
    private Collection $profissional;

    public function __construct()
    {
        $this->profissional = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getPeriodoInicial(): \DateTimeInterface
    {
        return $this->periodoInicial;
    }

    public function setPeriodoInicial(\DateTimeInterface $periodoInicial): void
    {
        $this->periodoInicial = $periodoInicial;
    }

    public function getPeriodoFinal(): \DateTimeInterface
    {
        return $this->periodoFinal;
    }

    public function setPeriodoFinal(\DateTimeInterface $periodoFinal): void
    {
        $this->periodoFinal = $periodoFinal;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return Collection<int, Profissional>
     */
    public function getProfissional(): Collection
    {
        return $this->profissional;
    }

    public function addProfissional(Profissional $profissional): void
    {
        if (!$this->profissional->contains($profissional)) {
            $this->profissional->add($profissional);
        }
    }

    public function removeProfissional(Profissional $profissional): void
    {
        $this->profissional->removeElement($profissional);
    }

    public function isAtivo(): bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }

    public function __tostring(): string
    {
        return $this->getNome() . ' (' . $this->getId() . ')';
    }
}
