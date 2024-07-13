<?php

namespace App\Controller;

use App\Form\ResponsavelType;
use App\Service\ResponsavelService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResponsavelController extends AbstractController
{
    public function __construct(ResponsavelService $service)
    {
        parent::__construct(
            ResponsavelType::class,
            $service,
            'responsavel'
        );
    }

    #[Route('/responsavel', name: 'app_responsavel_home', methods: ['GET'])]
    public function index(): Response
    {
        return parent::index();
    }

    #[Route('/responsavel/criar', name: 'app_responsavel_criar', methods:['GET', 'POST'])]
    public function create(Request $request): Response
    {
        return parent::create($request);
    }

    #[Route('/responsavel/editar/{id}', name: 'app_responsavel_editar', methods:['GET', 'POST'])]
    public function editar(Request $request, int $id): Response
    {
        return parent::editar($request, $id);
    }

    #[Route('/responsavel/remover/{id}', name: 'app_responsavel_remover', methods:['POST'])]
    public function remove(Request $request, int $id): Response
    {
        return parent::remove($request, $id);
    }
}
