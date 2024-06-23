<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnimalController extends AbstractController
{
    #[Route('/animal', name: 'app_animal_home')]
    public function index(): Response
    {
        return parent::index();
    }
}
