<?php

namespace App\Entity;

use App\Repository\PagamentoRepository;
use App\Traits\Timestamps;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(schema: 'clinica', name: 'pagamento')]
#[ORM\Entity(PagamentoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Pagamento extends AbstractEntity
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
    #[ORM\Column(name: 'pagamento', type:'string', nullable: false)]
    private string $pagamento;

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
    public function getPagamento(): string
    {
        return $this->pagamento;
    }

    /**
     * @param string $pagamento
     */
    public function setPagamento(string $pagamento): void
    {
        $this->pagamento = $pagamento;
    }
}