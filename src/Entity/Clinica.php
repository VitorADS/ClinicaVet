<?php

namespace App\Entity;

use App\Repository\ClinicaRepository;
use App\Traits\Timestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\PersistentCollection;

#[ORM\Table(schema: 'clinica', name: 'clinica')]
#[ORM\Entity(ClinicaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Clinica extends AbstractEntity
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
    #[ORM\Column(name: 'email', type:'string', nullable: false)]
    private string $email;

    /**
     * @var string
     */
    #[ORM\Column(name: 'telefone', type:'string', nullable: false)]
    private string $telefone;

    /**
     * @var ArrayCollection
     */
    #[OneToMany(targetEntity: ProfissionalClinica::class, mappedBy: 'clinica')]
    private Collection $profissionaisClinica;

    public function __construct()
    {
        $this->profissionaisClinica = new ArrayCollection();
    }

    /**
     * @return PersistentCollection
     */
    public function getProfissionaisClinica(): Collection
    {
        return $this->profissionaisClinica;
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getTelefone(): string
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     */
    public function setTelefone(string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function __toString(): string
    {
        return $this->getNome();
    }
}