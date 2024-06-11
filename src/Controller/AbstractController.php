<?php

namespace App\Controller;

use App\Entity\AbstractEntity;
use App\Service\AbstractService;
use App\Utils\Form;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as ControllerAbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends ControllerAbstractController
{
    protected string $entity;

    public function __construct(
        protected string $form,
        protected AbstractService $service,
        protected string $view,
    )
    {
        $this->entity = $this->service->getEntityClass();
    }

    // #[Route('/view', name: 'app_view_home')]
    public function index(): Response
    {
        $user = $this->getUser();
        $registros = $this->service->findBy([]);
        
        return $this->render("{$this->view}/index.html.twig", compact(
            'user',
            'registros'
        ));
    }

    // #[Route('/view/criar', name: 'app_view_criar', methods:['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $user = $this->getUser();
        $entity = new $this->entity();
        $form = $this->createForm($this->form, $entity);

        if($request->getMethod() === Request::METHOD_GET){
            return $this->render("{$this->view}/create.html.twig", compact('user', 'form'));
        }

        $form->handleRequest($request);

        if($form->isValid()){
            $entity = $this->service->save($entity);
            $this->addFlash('success', 'Registro criado com sucesso!');
            return $this->redirectToRoute("app_{$this->view}_editar", ['id' => $entity->getId()]);
        }

        $error = Form::getErrorsForm($form);
        $this->addFlash('danger', $error);
        return $this->render("{$this->view}/create.html.twig", compact('user', 'form'));
    }

    // #[Route('/view/editar/{id}', name: 'app_view_editar', methods:['GET', 'POST'])]
    public function editar(Request $request, int $id): Response
    {
        $entity = $this->service->find($id);

        if(!$entity instanceof AbstractEntity){
            $this->addFlash('danger', 'Registro nao encontrado!');
        } else {
            $user = $this->getUser();
            $form = $this->createForm($this->form, $entity, ['editar' => true]);

            if($request->getMethod() === Request::METHOD_GET){
                return $this->render("{$this->view}/editar.html.twig", compact('user', 'form'));
            }

            $form->handleRequest($request);

            if($form->isValid()){
                $entity = $this->service->save($entity, $id);
                $this->addFlash('success', 'Registro editado com sucesso');
                return $this->redirectToRoute("app_{$this->view}_home");
            }

            $error = Form::getErrorsForm($form);
            $this->addFlash('danger', $error);
            return $this->render("{$this->view}/editar.html.twig", compact('user', 'form'));
        }
    }

    // #[Route('/view/remover/{id}', name: 'app_view_editar', methods:['POST'])]
    public function remove(Request $request, int $id): Response
    {
        $entity = $this->service->find($id);

        if(!$entity instanceof AbstractEntity){
            $this->addFlash('danger', 'Registro nao encontrado!');
        } else {
            try{
                $this->service->remove($entity);
                $this->addFlash('success', 'Registro removido!');
            }catch(Exception $e){
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->redirectToRoute("app_{$this->view}_home");
    }
}