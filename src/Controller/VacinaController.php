<?php

namespace App\Controller;

use App\Entity\Atendimento;
use App\Entity\AtendimentoVacina;
use App\Form\AtendimentoVacinaType;
use App\Form\VacinaType;
use App\Service\AtendimentoService;
use App\Service\AtendimentoVacinaService;
use App\Service\VacinaService;
use App\Utils\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VacinaController extends AbstractController
{

    public function __construct(VacinaService $service)
    {
        parent::__construct(
            VacinaType::class,
            $service,
            'vacina'
        );
    }

    #[Route('/vacina', name: 'app_vacina_home', methods: ['GET'])]
    public function index(): Response
    {
        return parent::index();
    }

    #[Route('/vacina/criar', name: 'app_vacina_criar', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        return parent::create($request);
    }

    #[Route('/vacina/editar/{id}', name: 'app_vacina_editar', methods: ['GET', 'POST'])]
    public function editar(Request $request, int $id): Response
    {
        return parent::editar($request, $id);
    }

    #[Route('/vacina/remover/{id}', name: 'app_vacina_remover', methods: ['POST'])]
    public function remove(Request $request, int $id): Response
    {
        return parent::remove($request, $id);
    }

    #[Route('/vacina/adicionar-aplicacao/{idAtendimento}', name: 'app_vacina_adicionar_aplicacao', methods: ['GET', 'POST'])]
    public function adicionarAplicacao(Request $request, int $idAtendimento, AtendimentoService $atendimentoService): JsonResponse
    {
        /** @var Atendimento $atendimento */
        $atendimento = $atendimentoService->find($idAtendimento);

        if(!$atendimento instanceof Atendimento){
            $this->addFlash('danger', 'Atendimento nao encontrado');
            return $this->json([
                'success' => false,
                'message' => 'Atendimento nao encontado!'
            ]);
        }

        if($request->isMethod(Request::METHOD_GET)){
            $vacinas = $this->service->getVacinas();

            return $this->json([
                'success' => true,
                'vacinas' => $vacinas,
                'message' => ''
            ]);
        }
        
        $atendimentoVacina = new AtendimentoVacina();
        $form = $this->createForm(AtendimentoVacinaType::class, $atendimentoVacina);
        $form->submit(json_decode($request->getContent(), true));

        if($form->isValid()){
            try{
                $atendimento->addVacina($atendimentoVacina);
                $atendimentoService->save($atendimento, $atendimento->getId());
                
                $this->addFlash('success','Aplicacao adicionada!');
                return $this->json([
                    'success' => true,
                    'message' => ''
                ]);
            }catch(\Throwable $th){
                return $this->json([
                    'success' => false,
                    'message' => $th->getMessage()
                ]);
            }
        }

        $erros = Form::getErrorsForm($form);
        return $this->json([
            'success' => false,
            'message' => $erros
        ]);
    }

    #[Route('/vacina/remover-aplicacao/{idAtendimento}', name: 'app_vacina_remover_aplicacao', methods: ['POST'])]
    public function removerAplicacao(Request $request, int $idAtendimento, AtendimentoVacinaService $atendimentoVacinaService): Response
    {
        try{
            $idAplicacao = filter_input(INPUT_POST, 'vacina', FILTER_VALIDATE_INT);

            if(empty($idAplicacao)){
                throw new \Exception('Erro ao receber codigo da aplicacao de vacina');
            }

            $atendimentoVacinaService->removerAplicacao($idAplicacao);
            $this->addFlash('success', 'Aplicacao removida!');
        }catch(\Throwable $th){
            $this->addFlash('danger', $th->getMessage());
        }

        return $this->redirectToRoute('app_atendimento_editar', ['id'=> $idAtendimento]);
    }
}
