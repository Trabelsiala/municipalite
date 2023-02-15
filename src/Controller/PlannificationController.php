<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlannificationController extends AbstractController
{
    #[Route('/plannification', name: 'app_plannification')]
    public function index(): Response
    {
        return $this->render('plannification/index.html.twig', [
            'controller_name' => 'PlannificationController',
        ]);
    }
}
