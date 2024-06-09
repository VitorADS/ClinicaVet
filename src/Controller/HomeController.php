<?php

namespace App\Controller;

use App\Entity\Profissional;
use App\Form\ProfissionalType;
use App\Service\ProfissionalService;
use App\Utils\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    
    public function __construct(
        private ProfissionalService $profissionalService
    )
    {
    }

    #[Route('/', name: 'app_home_login', methods:['GET', 'POST'])]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser()){
            return $this->redirectToRoute('app_atendimento_home');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('home/index.html.twig', compact(
            'error',
            'lastUsername'
        ));
    }

    #[Route('/register', name: 'app_home_register', methods:['GET', 'POST'])]
    public function register(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $profissional = new Profissional();
        $registerForm = $this->createForm(ProfissionalType::class, $profissional);

        if($request->getMethod() === Request::METHOD_GET){
            return $this->render('home/register.html.twig', compact('registerForm'));
        }

        $registerForm->handleRequest($request);

        if($registerForm->isValid()){
            $submittedData = $registerForm->getData();
            $profissional->setPassword($hasher->hashPassword($profissional, $registerForm->get('password')->getData()));
            $profissional = $this->profissionalService->save($profissional);

            $this->addFlash('success', 'Profissional registrado com sucesso!');
            return $this->redirectToRoute('app_home_login');
        }

        $error = Form::getErrorsForm($registerForm);
        $this->addFlash('danger', $error);
        return $this->render('home/register.html.twig', compact('registerForm'));
    }
}
