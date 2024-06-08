<?php

namespace App\Entity;

use App\Repository\RacaRepository;
use App\Traits\Timestamps;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(schema: 'clinica', name: 'raca')]
#[ORM\Entity(RacaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Raca{

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
    #[ORM\Column(name: 'raca', type:'string', nullable: false)]
    private string $raca;

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
    public function getRaca(): string
    {
        return $this->raca;
    }

    /**
     * @param string $raca
     */
    public function setRaca(string $raca): void
    {
        $this->raca = $raca;
    }
}