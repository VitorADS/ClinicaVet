<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
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
        $route = $request->attributes;
        
        // if(!$this->startsWithValidLanguage($request)){
        //     $response = new Response(status: 302);
        //     $response->headers->add(['Location' => "/$language" . $request->getPathInfo()]);
        //     $event->setResponse($response);
        // }
    }

    private function startsWithValidLanguage(Request $request): bool
    {
        // foreach($this->validLanguages as $language){
        //     if(str_starts_with($request->getPathInfo(), "/$language")){
        //         return true;
        //     }
        // }
        return false;
    }
}