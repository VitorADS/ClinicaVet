<?php

namespace App\Controller;

use App\Form\AtendimentoType;
use App\Service\AtendimentoService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AtendimentoController extends AbstractController
{

    public function __construct(AtendimentoService $service)
    {
        parent::__construct(
            AtendimentoType::class,
            $service,
            'atendimento'
        );
    }

    #[Route('/atendimento', name: 'app_atendimento_home', methods:['GET'])]
    public function index(): Response
    {
        return parent::index();
    }

    #[Route('/atendimento/criar', name: 'app_atendimento_criar', methods:['GET', 'POST'])]
    public function create(Request $request): Response
    {
        return parent::create($request);
    }
}
