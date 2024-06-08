<?php

namespace App\Entity;

use App\Repository\TipoRepository;
use App\Traits\Timestamps;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(schema: 'clinica', name: 'tipo')]
#[ORM\Entity(TipoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Tipo extends AbstractEntity
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
    #[ORM\Column(name: 'tipo', type:'string', nullable: false)]
    private string $tipo;

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
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }
}