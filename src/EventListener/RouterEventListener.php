<?php

namespace App\EventListener;

use App\Entity\Papel;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\Cache\CacheInterface;

#[AsEventListener(event: 'kernel.request')]
class RouterEventListener
{
    public function __construct(
        private RouterInterface $router,
        private CacheInterface $cache,
        private TokenStorageInterface $token
    )
    {
    }

    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $cache = $this->cache;
        $result = $this->cache->get('papel', function () use ($request, $cache) {
            if($this->token->getToken() && $request->attributes->get('_route') !== 'app_papel_selecionar') {
                $request->getSession()->getFlashBag()->add('danger', 'Selecione o papel');
                return new RedirectResponse($this->router->generate('app_papel_selecionar'));
            }

            return null;
        });

        if($result instanceof RedirectResponse){
            $cache->delete('papel');
            $event->setResponse($result);
        }

        if(
            $result instanceof Papel && 
            $request->attributes->get('_route') !== 'app_papel_selecionar' && 
            !in_array($request->attributes->get('_route'), $result->getRoles())
        ){
            $request->getSession()->getFlashBag()->add('danger', 'Acesso nao autorizado');
            $event->setResponse(new RedirectResponse($this->router->generate('app_papel_selecionar')));
        }

        if(!$result && ($request->attributes->get('_route') !== 'app_home_login' && $request->attributes->get('_route') !== 'app_papel_selecionar')){
            $cache->delete('papel');
            $event->setResponse(new RedirectResponse($this->router->generate('app_home_login')));
            // @TODO
            // Redirecionar para uma pagina de erro
        }
    }
}