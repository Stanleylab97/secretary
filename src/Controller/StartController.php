<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StartController extends AbstractController
{

    /**
     * @Route("/dashboard", name="dashboard")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_SECRETARY') or is_granted('ROLE_DIRECTOR')")
     */
    public function dashboard(): Response
    {
        return $this->render('start/dashboard.html.twig', [
            'controller_name' => 'StartController',
        ]);
    }
}