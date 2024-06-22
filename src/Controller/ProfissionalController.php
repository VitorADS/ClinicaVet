<?php

namespace App\Controller;

use App\Form\ProfissionalType;
use App\Service\ProfissionalService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfissionalController extends AbstractController
{
    public function __construct(ProfissionalService $service)
    {
        parent::__construct(
            ProfissionalType::class,
            $service,
            'profissional'
        );
    }

    #[Route('/profissional', name: 'app_profissional_home', methods: ['GET'])]
    public function index(): Response
    {
        return parent::index();
    }

    #[Route('/profissional/criar', name: 'app_profissional_criar', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        return parent::create($request);
    }

    #[Route('/profissional/editar/{id}', name: 'app_profissional_editar', methods: ['GET', 'POST'])]
    public function editar(Request $request, int $id): Response
    {
        return parent::editar($request, $id);
    }

    #[Route('/profissional/remover/{id}', name: 'app_profissional_remover', methods:['POST'])]
    public function remove(Request $request, int $id): Response
    {
        return parent::remove($request, $id);
    }
}
