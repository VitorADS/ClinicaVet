<?php

namespace App\Controller;

use App\Entity\ProfissionalClinica;
use App\Form\ClinicaType;
use App\Service\ClinicaService;
use App\Service\ProfissionalClinicaService;
use App\Service\ProfissionalService;
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
        if(!$this->existeRegistro($id)){
            $this->addFlash('danger', 'Clinica nao encontrada');
            return $this->redirectToRoute('app_clinica_home', ['user' => $this->getUser()]);
        }
        
        $this->viewParams['profissionais'] = $this->registro->getProfissionaisClinica();
        return parent::editar($request, $id);
    }

    #[Route('/clinica/remover/{id}', name: 'app_clinica_remover', methods:['POST'])]
    public function remove(Request $request, int $id): Response
    {
        return parent::remove($request, $id);
    }

    #[Route('/clinica/profissional/add/{id}', name: 'app_clinica_profissional_add', methods:['GET', 'POST'])]
    public function addProfissional(
        Request $request,
        int $id,
        ProfissionalService $profissionalService,
        ProfissionalClinicaService $profissionalClinicaService
    ): Response
    {
        $user = $this->getUser();

        if(!$this->existeRegistro($id)){
            $this->addFlash('danger', 'Clinica nao encontrada');
            return $this->redirectToRoute('app_clinica_home', [$user]);
        }

        $profissionais = $profissionalService->getProfissionaisCadastraveis($id);

        if($request->getMethod() === Request::METHOD_GET){
            return $this->render('clinica/addProfissional.html.twig', compact(
                'profissionais',
                'user'
            ));
        }

        try{
            $values = $request->request->all();

            if(empty($values['id'])){
                throw new \Exception('Selecione ao menos um profissional!');
            }

            $ids = $values['id'];
            $profissionalClinicaService->adicionarProfissionalClinica($ids, $id);
            $this->addFlash('success', 'Profissionais vinculados!');
            return $this->redirectToRoute('app_clinica_editar', ['id' => $id]);
        }catch(\Exception $e){
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('app_clinica_profissional_add', ['id' => $id]);
    }

    #[Route('/clinica/profissional/remover/{profissionalClinica}', name: 'app_clinica_profissional_remover', methods:['POST'])]
    public function removerProfissional(Request $request, ProfissionalClinica $profissionalClinica, ProfissionalClinicaService $service): Response
    {
        if($profissionalClinica->hasDependents()){
            $this->addFlash('danger', 'Profissional possui atendimentos vinculados!');
            return $this->redirectToRoute('app_clinica_home');
        }

        $service->remove($profissionalClinica);
        $this->addFlash('success','Profissional removido!');
        return $this->redirectToRoute('app_clinica_home');
    }
}
