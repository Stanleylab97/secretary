<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    /**
     * @Route("/mission", name="createmission")
     */
    public function index(): Response
    {
        return $this->render('mission/index.html.twig', [
            'controller_name' => 'MissionController',
        ]);
    }

    /**
     * @Route("/missions", name="list_missions")
     */
    public function list_missions(): Response
    {
        return $this->render('mission/liste_missions.html.twig', [
            'controller_name' => 'MissionController',
        ]);
    }
}
