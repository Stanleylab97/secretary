<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Direction;
use App\Entity\Service;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AgentController extends AbstractController
{
    

     /**
     * @Route("/admin/createagent", name="createAgent", methods={"GET","POST"})
     */
    public function create(Request $request,EntityManagerInterface $em): Response
    {
        $agents = $this->getDoctrine()->getRepository(Agent::class) ->findAll();
        
        $form=$this->createFormBuilder()
             ->add('nom',TextType::class,['attr'=>['placeholder'=>'Nom et prénom']])
             ->add('matricule',TextType::class,['attr'=>['placeholder'=>'Ex:1409']])
             ->add('fonction',TextType::class,['attr'=>['placeholder'=>'Chef service Réseau']])
             ->add('direction', EntityType::class, ['class' => Direction::class,'choice_label' => 'libelle'])
             ->add('service',EntityType::class, ['class' => Service::class,'choice_label' => 'libelle'])
             ->add('sexe',ChoiceType::class,['choices'=>$this->getChoicesexe()])
             ->add('contact',TextType::class,['attr'=>['placeholder'=>'Ex: 97XXXXXX']])
             ->add('Submit',SubmitType::class,['label'=>'Ajouter agent'])
             ->getForm();
          
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $data=$form->getData(); 
           
            $agent=new Agent;
            $agent->setNom($data['nom']);
            $agent->setSexe($data['sexe']);
            $agent->setMatricule($data['matricule']);
            $agent->setDirection($data['direction']);
            $agent->setService($data['service']);
            $agent->setFonction($data['fonction']);
            $agent->setContact($data['contact']);
            $em->persist($agent);
            $em->flush();

            $this->redirectToRoute('createAgent');

            
        }     
        return $this->render('agent/index.html.twig',[
            'form'=>$form->createView(),
            'agents'=>$agents
        ]);
    }

    public function getChoicesexe(){
        $choicies=Agent::SEXE;
        $output=[];
        foreach($choicies as $k=>$v){
            $output[$v]=$k;
        }
        return $output;
    }

    public function getDirectionChoicies(EntityManagerInterface $em, AgentRepository $repo){
        $choicies=$repo->findAll();
    }

}