<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClinicaController extends AbstractController
{
    #[Route('/clinica', name: 'app_clinica_home')]
    public function index(): Response
    {
        $user = $this->getUser();
        
        return $this->render('clinica/index.html.twig', compact(
            'user'
        ));
    }
}
