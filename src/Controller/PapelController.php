<?php

namespace App\Controller;

use App\Service\VacinaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PapelController extends AbstractController
{
    #[Route('/papel', name: 'app_papel')]
    public function index(RouterInterface $router, CacheInterface $cache, VacinaService $service): Response
    {
        $routeCollection = $router->getRouteCollection();
        $routes = [];

        $adapter = $cache->getPool();

        $value = $cache->get('test', function (ItemInterface $item) use ($service) {
            $item->expiresAfter(new \DateInterval('PT3600S'));
            
            return $service->findBy([]);
        });

        foreach($routeCollection as $key => $route){
            $routes[] = [
                'name' => $key,
                'path' => $route->getPath(),
                'methods' => $route->getMethods()
            ];
        }
    }
}
