<?php

namespace App\Entity;

use App\Repository\VacinaRepository;
use App\Traits\Timestamps;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(schema: 'clinica', name: 'vacina')]
#[ORM\Entity(VacinaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Vacina{

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
}