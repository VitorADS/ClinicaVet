<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\ResponsavelAnimal;
use App\Form\AnimalType;
use App\Service\AnimalService;
use App\Service\ResponsavelAnimalService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnimalController extends AbstractController
{
    public function __construct(AnimalService $service)
    {
        parent::__construct(
            AnimalType::class,
            $service,
            'animal'
        );
    }

    #[Route('/animal', name: 'app_animal_home', methods: ['GET'])]
    public function index(): Response
    {
        return parent::index();
    }

    #[Route('/animal/criar', name: 'app_animal_criar', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        return parent::create($request);
    }

    #[Route('/animal/editar/{id}', name: 'app_animal_editar', methods: ['GET', 'POST'])]
    public function editar(Request $request, int $id): Response
    {
        if(!$this->existeRegistro($id)){
            $this->addFlash('danger', 'Animal nao encontrado');
            return $this->redirectToRoute('app_animal_home');
        }

        $this->viewParams['responsaveis'] = $this->registro->getResponsaveis();
        return parent::editar($request, $id);
    }

    #[Route('/animal/remover/{id}', name: 'app_animal_remover', methods:['POST'])]
    public function remove(Request $request, int $id): Response
    {
        return parent::remove($request, $id);
    }

    #[Route('/animal/responsavel/add/{id}', name: 'app_animal_responsavel_add', methods:['GET', 'POST'])]
    public function addResponsavel(Request $request, int $id, ResponsavelAnimalService $responsavelAnimalService): Response
    {
        $user = $this->getUser();

        if(!$this->existeRegistro($id)){
            $this->addFlash('danger', 'Animal nao encontrado');
            return $this->redirectToRoute('app_animal_home');
        }

        $responsaveis = $this->service->getResponsaveisCadastraveis($id);

        if($request->getMethod() === Request::METHOD_GET){
            return $this->render('animal/addResponsavel.html.twig', compact(
                'user',
                'responsaveis'
            ));
        }

        try{
            $values = $request->request->all();
            $padrao = filter_input(INPUT_POST, 'padrao', FILTER_VALIDATE_INT);

            if(empty($values['id'])){
                throw new \Exception('Selecione ao menos um responsavel!');
            }

            if(!$this->registro->getResponsavelPadrao() && !in_array($padrao, $values['id'])){
                throw new \Exception('O responsavel padrao nao foi selecionado!');
            }

            $ids = $values['id'];
            $responsavelAnimalService->adicionarResponsavelAnimal($ids, $this->registro, $padrao);
            $this->addFlash('success', 'Responsaveis vinculados!');
            return $this->redirectToRoute('app_animal_editar', ['id' => $id]);
        }catch(\Exception $e){
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('app_animal_responsavel_add', ['id' => $id]);
    }

    #[Route('/animal/responsavel/padrao/{animal}', name: 'app_animal_responsavel_padrao', methods:['POST'])]
    public function definirResponsavelPadrao(Request $request, Animal $animal, ResponsavelAnimalService $responsavelAnimalService): Response
    {
        $idResponsavelAnimal = filter_input(INPUT_POST, 'responsavel', FILTER_VALIDATE_INT);

        try{
            $this->service->defineResponsavel($idResponsavelAnimal, $animal, $responsavelAnimalService);
            $this->addFlash('success', 'Responsavel definido!');
        }catch(\Throwable $e){
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('app_animal_editar', ['id' => $animal->getId()]);
    }

    #[Route('/animal/responsavel/remover/{responsavelAnimal}', name: 'app_animal_responsavel_remover', methods:['POST'])]
    public function removerResponsavel(Request $request, ResponsavelAnimal $responsavelAnimal, ResponsavelAnimalService $service): Response
    {
        $idAnimal = $responsavelAnimal->getAnimal()->getId();

        try{
            $service->remove($responsavelAnimal);
            $this->addFlash('success','Responsavel removido!');
        }catch(\Throwable $e){
            $this->addFlash('danger', $e->getMessage());
        }
        
        return $this->redirectToRoute('app_animal_editar', ['id' => $idAnimal]);
    }
}
