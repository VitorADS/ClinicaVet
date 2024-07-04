<?php

namespace App\Entity;

use App\Repository\ProfissionalRepository;
use App\Traits\Timestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(schema: 'clinica', name: 'profissional')]
#[ORM\Entity(ProfissionalRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Profissional extends AbstractEntity implements UserInterface, PasswordAuthenticatedUserInterface
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
    #[ORM\Column(name: 'telefone', type:'string', nullable: false)]
    private string $telefone;

    /**
     * @var string
     */
    #[ORM\Column(name: 'email', type:'string', nullable: false)]
    private string $email;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column(name: 'roles', type: 'json', nullable: false)]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var PersistentCollection
     */
    #[ORM\OneToMany(targetEntity: ProfissionalClinica::class, mappedBy: 'profissional')]
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
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function __tostring(): string
    {
        return $this->getNome() . " ({$this->getId()})";
    }
}