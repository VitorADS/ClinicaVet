<?php

namespace App\Controller;

use App\Entity\Atendimento;
use App\Entity\Clinica;
use App\Form\AtendimentoType;
use App\Service\AtendimentoService;
use App\Service\ClinicaService;
use DateTime;
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
    public function createAtendimento(Request $request, ClinicaService $clinicaService): Response
    {
        $idClinica = filter_input(INPUT_GET, 'clinica', FILTER_VALIDATE_INT);
        $clinica = $clinicaService->find($idClinica);

        if(!$clinica instanceof Clinica){
            $this->addFlash('danger', 'Clinica nao encontrada!');
            return $this->redirectToRoute('app_clinica_home');
        }
        
        /** @var Atendimento $this->registro */
        $this->registro = new Atendimento();
        $this->registro->setData(new DateTime());
        $this->formParams['clinica'] = [$clinica];
        $this->formParams['profissionaisClinica'] = $clinica->getProfissionaisClinica();

        return parent::create($request);
    }
}
