<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OutilController extends AbstractController
{
    #[Route('/outil', name: 'app_outil')]
    public function index(): Response
    {
        return $this->render('outil/index.html.twig', [
            'controller_name' => 'OutilController',
        ]);
    }
}
