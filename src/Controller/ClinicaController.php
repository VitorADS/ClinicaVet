<?php

namespace App\Controller;

use App\Form\ClinicaType;
use App\Service\ClinicaService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClinicaController extends AbstractController
{
    public function __construct(ClinicaService $service)
    {
        parent::__construct(
            ClinicaType::class,
            $service,
            'clinica'
        );
    }

    #[Route('/clinica', name: 'app_clinica_home')]
    public function index(): Response
    {
        return parent::index();
    }

    #[Route('/clinica/criar', name: 'app_clinica_criar', methods:['GET', 'POST'])]
    public function create(Request $request): Response
    {
        return parent::create($request);
    }

    #[Route('/clinica/editar/{id}', name: 'app_clinica_editar', methods:['GET', 'POST'])]
    public function editar(Request $request, int $id): Response
    {
        return parent::editar($request, $id);
    }

    #[Route('/clinica/remover/{id}', name: 'app_clinica_remover', methods:['POST'])]
    public function remove(Request $request, int $id): Response
    {
        return parent::remove($request, $id);
    }
}
