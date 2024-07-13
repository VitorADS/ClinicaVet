<?php

namespace App\Controller;

use App\DTO\PapelDTO;
use App\Form\PapelType;
use App\Form\SelecaoPapelType;
use App\Service\PapelService;
use App\Utils\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PapelController extends AbstractController
{

    public function __construct(PapelService $service, private CacheInterface $cache)
    {
        parent::__construct(
            PapelType::class,
            $service,
            'papel'
        );
    }

    #[Route('/papel', name: 'app_papel_home', methods: ['GET'])]
    public function index(): Response
    {
        return parent::index();
    }

    #[Route('/papel/criar', name: 'app_papel_criar', methods: ['GET', 'POST'])]
    public function createPapel(Request $request, RouterInterface $router): Response
    {
        $routeCollection = $router->getRouteCollection();
        $routes = [];

        foreach ($routeCollection as $key => $route) {
            $routes[] = [
                $key => $key
            ];
        }

        $this->formParams['papeis'] = $routes;
        return parent::create($request);
    }

    #[Route('/papel/editar/{id}', name: 'app_papel_editar', methods: ['GET', 'POST'])]
    public function editarPapel(Request $request, int $id, RouterInterface $router): Response
    {
        if (!$this->existeRegistro($id)) {
            $this->addFlash('danger', 'Papel nao encontradp');
            return $this->redirectToRoute('app_papel_home');
        }

        $routeCollection = $router->getRouteCollection();
        $routes = [];

        foreach ($routeCollection as $key => $route) {
            $routes[] = [
                $key => $key
            ];
        }

        $this->formParams['papeis'] = $routes;
        return parent::editar($request, $id);
    }

    #[Route('/papel/remover/{id}', name: 'app_papel_remover', methods: ['POST'])]
    public function remove(Request $request, int $id): Response
    {
        return parent::remove($request, $id);
    }

    #[Route('/papel/selecionar-papel', name: 'app_papel_selecionar', methods: ['GET', 'POST'])]
    public function selecionarPapel(Request $request): Response
    {
        $papeis = $this->getUser()->getPapeis();
        $papelDTO = new PapelDTO();
        $form = $this->createForm(SelecaoPapelType::class, $papelDTO, ['papeis' => $papeis]);

        if ($request->getMethod() === Request::METHOD_POST) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->cache->delete('papel');
                $papel = $this->cache->get('papel', function (ItemInterface $item) use ($papelDTO) {
                    $item->expiresAfter(new \DateInterval('PT3600S'));

                    return $papelDTO->papel;
                });

                return $this->redirectToRoute('app_atendimento_home');
            }

            $erros = Form::getErrorsForm($form);

            $this->addFlash('danger', $erros);
            return $this->redirectToRoute('app_papel_selecionar');
        }

        return $this->render("papel/selecionar.html.twig", compact(
                'form'
            )
        );
    }
}
