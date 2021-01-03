<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StartController extends AbstractController
{
    /**
     * @Route("/", name="login")
     */
    public function index(): Response
    {
        return $this->render('start/index.html.twig', [
            'controller_name' => 'StartController',
        ]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {
        return $this->render('start/dashboard.html.twig', [
            'controller_name' => 'StartController',
        ]);
    }
}
