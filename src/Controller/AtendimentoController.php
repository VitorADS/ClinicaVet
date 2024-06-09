<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AtendimentoController extends AbstractController
{
    #[Route('/atendimento', name: 'app_atendimento_home')]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('atendimento/index.html.twig', compact(
            'user'
        ));
    }
}
