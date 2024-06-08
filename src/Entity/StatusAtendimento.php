<?php

namespace App\Entity;

use App\Repository\StatusAtendimentoRepository;
use App\Traits\Timestamps;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(schema: 'clinica', name: 'status_atendimento')]
#[ORM\Entity(StatusAtendimentoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class StatusAtendimento extends AbstractEntity
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
    #[ORM\Column(name: 'status', type:'string', nullable: false)]
    private string $status;

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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}