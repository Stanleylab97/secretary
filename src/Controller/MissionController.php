<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Mission;
use App\Entity\Chauffeur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MissionController extends AbstractController
{
    /**
     * @Route("/mission/new", name="create_mission")
     * @Route("/mission/{id}/edit", name="edit_mission")
     */
    public function index(Request $request,EntityManagerInterface $em,Mission $mission=null): Response
    {
        $missions = $this->getDoctrine()->getRepository(Mission::class) ->findAll();
        $agents=$this->getDoctrine()->getRepository(Agent::class) ->findAll();
        $chauffeurs=$this->getDoctrine()->getRepository(Chauffeur::class) ->findAll();
        if(!$mission){
            $mission=new Mission;
        }

        $form=$this->createFormBuilder($mission)
             ->add('noteService',TextType::class)
             ->add('agent',EntityType::class, ['class'=> Agent::class,'choice_label' => 'nom','attr' => ['class' => 'select-chosen']])
             ->add('lieu',TextType::class)
             ->add('objet',TextareaType::class)
             ->add('primeChef',TextType::class)
             ->add('dateDepart',DateType::class, ['widget' => 'single_text'])
             ->add('dateRetour',DateType::class, ['widget' => 'single_text'])
             ->add('typeMission',ChoiceType::class,['choices'=>$this->getTypeMission()])
             ->add('moyen',ChoiceType::class,['choices'=>$this->getChoiceMoyen()]) 
             ->add('nbjrs')
             ->getForm();
          
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $mission->setCreatedAt(new \DateTime());
            $mission->setSavedBy("ABOU Nadiath");
            $mission->setTraitement(false);            
            $em->persist($mission);
            $em->flush();   
            
            return $this->redirectToRoute('create_mission');  
        }
        return $this->render('mission/index.html.twig', [
            'missions' => $missions,
            'agents'=>$agents,
            'chauffeurs'=>$chauffeurs,
            'form'=>$form->createView(),
        ]);

}

public function getChoiceMoyen(){
    $choices=Mission::Moyen;
    $output=[];
    foreach($choices as $k=>$v){
        $output[$v]=$k;
    }
    return $output;
}

public function getTypeMission(){
    $choices=Mission::TYPEMISSION;
    $output=[];
    foreach($choices as $k=>$v){
        $output[$v]=$k;
    }
    return $output;
}

    /**
     * @Route("/missions", name="list_missions")
     */
    public function list_missions(Request $request,EntityManagerInterface $em): Response
    {
        $missions = $this->getDoctrine()->getRepository(Mission::class) ->findAll();
        $agents=$this->getDoctrine()->getRepository(Agent::class) ->findAll();
        return $this->render('mission/liste_missions.html.twig', [
            'missions' => $missions,
            'agents'=>$agents,
        ]);
    }
}