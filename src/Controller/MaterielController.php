<?php

namespace App\Controller;

use DateTime;
use App\Entity\Agent;
use App\Entity\Materiel;
use App\Entity\AffectationMateriel;
use App\Entity\ApproMateriel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaterielController extends AbstractController
{
    /**
     * @Route("/materiel/new", name="new_materiel")
     * @Route("/materiel/{id}/edit", name="edit_materiel")
     */
    public function index(Request $request,EntityManagerInterface $em,AffectationMateriel $affectationMateriel=null): Response
    {
        $affectations = $this->getDoctrine()->getRepository(AffectationMateriel::class) ->findAll();
        if(!$affectationMateriel){
            $affectationMateriel=new AffectationMateriel;
        }
        $form=$this->createFormBuilder($affectationMateriel)
             ->add('agent',EntityType::class, ['class'=> Agent::class,'choice_label' => 'nom','attr' => ['class' => 'select-chosen']])
             ->add('materiel',EntityType::class, ['class'=> Materiel::class,'choice_label' => 'libelle','attr' => ['class' => 'select-chosen']])
             ->add('code',TextType::class,['required'=>false])
             ->add('qte',TextType::class)
             ->getForm();
          
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ 
           
            
            $affectationMateriel->setDateAffectation(new \DateTime());
            $affectationMateriel->setAffectedBy("NATA Abiba");
           
            $em->persist($affectationMateriel);
            $em->flush();

            return $this->redirectToRoute('new_materiel');  
        }   

        return $this->render('materiel/index.html.twig', [
           'affectations'=>$affectations,
            'form'=>$form->createView(), 
        ]);
    }

     /**
     * @Route("/materiel/approvisionnement", name="approvisionnement")
     * @Route("/materiel/appro/{id}/edit", name="edit_appro")
     */
    public function approvisionnement(Request $request,EntityManagerInterface $em, ApproMateriel $appro=null): Response
    {
         $appros = $this->getDoctrine()->getRepository(ApproMateriel::class) ->findAll();
        if(!$appro){
            $appro=new ApproMateriel;
        }
        $form=$this->createFormBuilder($appro)
             ->add('materiel',EntityType::class, ['class'=> Materiel::class,'choice_label' => 'libelle','attr' => ['class' => 'select-chosen']])
             ->add('qte',TextType::class)
             ->getForm();
          
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ 
            $appro->setDateAppro(new \DateTime());
            $appro->setReceivedBy("NATA Abiba");
           
            $em->persist($appro);
            $em->flush();

            return $this->redirectToRoute('new_appro');  
        }   
        
        return $this->render('materiel/approvisionnement.html.twig', [
            'form'=>$form->createView(),
            'appros'=>$appros
        ]);
    }
}