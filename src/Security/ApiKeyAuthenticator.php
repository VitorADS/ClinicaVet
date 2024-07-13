<?php
namespace App\Security;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Contracts\Cache\CacheInterface;

class ApiKeyAuthenticator extends AbstractAuthenticator
{

    public function __construct(
        private RouterInterface $router,
        private CacheInterface $cache
    )
    {
    }

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning `false` will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request): ?bool
    {
        if($request->getMethod() === Request::METHOD_POST && $request->attributes->get('_route') === 'app_home_login'){
            return true;
        }

        return false;
    }

    public function authenticate(Request $request): Passport
    {
        $password = filter_var($request->getPayload()->get('_password'), FILTER_SANITIZE_STRING);
        $username = filter_var($request->getPayload()->get('_username'), FILTER_SANITIZE_STRING);
        // ...

        return new Passport(
            new UserBadge($username),
            new PasswordCredentials($password)
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse($this->router->generate('app_papel_selecionar'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        if($exception->getCode() === 0) {
            $request->getSession()->getFlashBag()->add('danger', 'Credenciais incorretas');
            return new RedirectResponse($this->router->generate('app_home_login'));
        }

        return null;
    }
}