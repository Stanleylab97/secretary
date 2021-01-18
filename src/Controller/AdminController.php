<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AdminController.php',
        ]);
    }

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function usersList(User $user=null,UserRepository $repo, Request $request, EntityManagerInterface $em): Response
    {
      
        return $this->render("admin/users.html.twig",[
            'users'=> $repo->findAll(),
        ]);
        
        
    }

     /**
     * @Route("/utilisateurs/edit/{id}", name="editRoles")
     */
    public function editUserRoles(User $user,UserRepository $repo,Request $request, EntityManagerInterface $em): Response
    {
        $form=$this->createForm(EditUserFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($user);
            $em->flush();
            $this->addFlash('message','Utilisateur modifié avec succès');
            return $this->redirectToRoute('admin_utilisateurs');
        }
        return $this->render("admin/edituser.html.twig", [
            'userform' => $form->createView()
        ]);
    } 
}