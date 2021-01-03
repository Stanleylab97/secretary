<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChauffeurController extends AbstractController
{
    

     /**
     * @Route("/createDriver", name="createDriver",methods={"GET","POST"})
     */
    public function create(Request $request,EntityManagerInterface $em): Response
    {
        $chauffeurs = $this->getDoctrine()->getRepository(Chauffeur::class) ->findAll();
        
        $form=$this->createFormBuilder()
             ->add('nom',TextType::class,['attr'=>['placeholder'=>'Nom et prénom']])
             ->add('contact',TextType::class,['attr'=>['placeholder'=>'Ex: 97XXXXXX']])
             ->add('Submit',SubmitType::class,['label'=>'Ajouter un chauffeur'])
             ->getForm();
          
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $data=$form->getData(); 
           
            $chauffeur=new Chauffeur;
            $chauffeur->setNom($data['nom']);
            $chauffeur->setContacts($data['contact']);
            $em->persist($chauffeur);
            $em->flush();

            $this->redirectToRoute('createDriver');  
        }     
       
        return $this->render('chauffeur/index.html.twig', [
            'form'=>$form->createView(),
            'drivers'=>$chauffeurs
        ]);
    }



}
