<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use App\Entity\Mission;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChauffeurController extends AbstractController
{
    
     /**
     * @Route("/driver", name="driver_dash",methods={"GET","POST"})
     */
    public function index(Request $request,EntityManagerInterface $em): Response
    {
        $chauffeurs = $this->getDoctrine()->getRepository(Chauffeur::class) ->findAll();
        
        $form=$this->createFormBuilder()
             ->add('nom',TextType::class,['attr'=>['placeholder'=>'Nom et prénom']])
             ->add('permis',ChoiceType::class,['choices'=>$this->getChoicesexe()])
             ->add('contact',TextType::class,['attr'=>['placeholder'=>'Ex: 97XXXXXX']])
             ->add('Submit',SubmitType::class,['label'=>'Ajouter un chauffeur'])
             ->getForm();
          
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $data=$form->getData(); 
           
            $chauffeur=new Chauffeur;
            $chauffeur->setNom($data['nom']);
            $chauffeur->setContacts($data['contact']);
            $chauffeur->setPermis($data['permis']);
            $em->persist($chauffeur);
            $em->flush();

            $this->redirectToRoute('createDriver');  
        }     
       
        return $this->render('chauffeur/index.html.twig', [
            'form'=>$form->createView(),
            'drivers'=>$chauffeurs
        ]);
    }


     /**
     * @Route("/admin/createDriver", name="createDriver",methods={"GET","POST"})
     */
    public function createdriver(Request $request,EntityManagerInterface $em): Response
    {
        $chauffeurs = $this->getDoctrine()->getRepository(Chauffeur::class) ->findAll();
        
        $form=$this->createFormBuilder()
             ->add('nom',TextType::class,['attr'=>['placeholder'=>'Nom et prénom']])
             ->add('permis',ChoiceType::class,['choices'=>$this->getChoicesexe()])
             ->add('contact',TextType::class,['attr'=>['placeholder'=>'Ex: 97XXXXXX']])
             ->add('Submit',SubmitType::class,['label'=>'Ajouter un chauffeur'])
             ->getForm();
          
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $data=$form->getData(); 
           
            $chauffeur=new Chauffeur;
            $chauffeur->setNom($data['nom']);
            $chauffeur->setContacts($data['contact']);
            $chauffeur->setPermis($data['permis']);
            $em->persist($chauffeur);
            $em->flush();

           return $this->redirectToRoute('createDriver');  
        }     
       
        return $this->render('chauffeur/new_driver.html.twig', [
            'form'=>$form->createView(),
            'drivers'=>$chauffeurs
        ]);
    }

    public function getChoicesexe(){
        $choicies=Chauffeur::PERMIS;
        $output=[];
        foreach($choicies as $k=>$v){
            $output[$v]=$k;
        }
        return $output;
    }

     /**
     * @Route("/missions/showSorties", name="show_sorties",methods={"GET","POST"})
     */
    public function showSorties(Request $request,EntityManagerInterface $em): Response
    {
        $sorties = $em->createQuery(
            'SELECT m
            FROM App\Entity\Mission m
            ORDER BY m.createdAt DESC')
            ->getResult();

        return $this->render('chauffeur/liste_sorties.html.twig',[
            'missions'=>$sorties
        ]);
    }

}