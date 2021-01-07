<?php

namespace App\DataFixtures;

use App\Entity\AffectationMateriel;
use Faker;
use App\Entity\Agent;
use App\Entity\ApproMateriel;
use App\Entity\Mission;
use App\Entity\Service;
use App\Entity\ParcAuto;
use App\Entity\Direction;
use App\Entity\Materiel;
use App\Repository\AgentRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create();;

       
            $direction1=new Direction;
            $direction1->setCode('DSI');
            $direction1->setLibelle('Direction des Systèmes d\'Information');
            $manager->persist($direction1);
            $manager->flush();
           
            $direction2=new Direction;
            $direction2->setCode('DCF');
            $direction2->setLibelle('Direction Comptable et Financière');
            $manager->persist($direction2);
            $manager->flush();

            $direction3=new Direction;
            $direction3->setCode('DCC');
            $direction3->setLibelle('Direction de la Communication et de la Clientelle');
            $manager->persist($direction3);
            $manager->flush();

            $service1=new Service;
            $service1->setLibelle("Réseau");
            $service1->setDirection($direction1);
            $manager->persist($service1);
            $manager->flush();

            

            $service2=new Service;
            $service2->setLibelle("Développement");
            $service2->setDirection($direction1);
            $manager->persist($service2);
            $manager->flush();

            $service3=new Service;
            $service3->setLibelle("Base de données");
            $service3->setDirection($direction1);
            $manager->persist($service3);
            $manager->flush();

            $service4=new Service;
            $service4->setLibelle("Service Audit");
            $service4->setDirection($direction2);
            $manager->persist($service4);
            $manager->flush();

            $service7=new Service;
            $service7->setLibelle("Service Comptabilité");
            $service7->setDirection($direction2);
            $manager->persist($service7);
            $manager->flush();

            $service8=new Service;
            $service8->setLibelle("Service Finance");
            $service8->setDirection($direction2);
            $manager->persist($service8);
            $manager->flush();

            

            $service5=new Service;
            $service5->setLibelle("Sécretariat");
            $service5->setDirection($direction1);
            $manager->persist($service5);
            $manager->flush();

            $service6=new Service;
            $service6->setLibelle("Service commercial");
            $service6->setDirection($direction3);
            $manager->persist($service6);
            $manager->flush();

            for($i=0;$i<10;$i++){
            $vehicule=new ParcAuto();
            $vehicule->setCouleur($faker->colorName);
            $vehicule->setImmatriculation("BP".$faker->numberBetween($min = 0, $max = 9000)."RB");
            $i<5?$vehicule->setMarque("TOYOTA"):$vehicule->setMarque("FORD");
            $vehicule->setConsommation(8);
            $i<5?$vehicule->setModel($faker->randomElement($array = array ('Camry 2008','Corolla Drogba','Avensis'))):$vehicule->setModel($faker->randomElement($array = array ('Focus','Ranger','Pick-Up')));
            $manager->persist($vehicule);
            $manager->flush();
        } 

        
        $servicesd1=[$service1,$service2,$service3,$service5];
        $servicesd2=[$service4,$service7,$service8,$service5];
        $servicesd3=[$service7,$service5];

        for($i=0;$i<10;$i++){
            if($i<10){
                $agent=new Agent;
                $agent->setMatricule($faker->numberBetween($min = 1000, $max = 9999));
                $agent->setNom($faker->name);
                $agent->setDirection($direction2);
                $agent->setService($faker->randomElement($servicesd1));
                $agent->setFonction($faker->jobTitle);
                $agent->setContact($faker->e164PhoneNumber);
                $agent->setSexe(random_int(0, 1));
                $manager->persist($agent);
                $manager->flush();
            }
            if($i<8){
                $agent=new Agent;
                $agent->setMatricule($faker->numberBetween($min = 1000, $max = 9999));
                $agent->setNom($faker->name);
                $agent->setDirection($direction2);
                $agent->setService($faker->randomElement($servicesd2));
                $agent->setFonction($faker->jobTitle);
                $agent->setSexe(random_int(0, 1));
                $agent->setContact($faker->e164PhoneNumber);
                $manager->persist($agent);
                $manager->flush();
            }
            
            if($i<8){
                $agent=new Agent;
                $agent->setMatricule($faker->numberBetween($min = 1000, $max = 9999));
                $agent->setNom($faker->name);
                $agent->setDirection($direction3);
                $agent->setService($faker->randomElement($servicesd3));
                $agent->setFonction($faker->jobTitle);
                $agent->setSexe("".random_int(0, 1));
                $agent->setContact($faker->e164PhoneNumber);
                $manager->persist($agent);
                $manager->flush();
            }
            
        }
        $agent1=new Agent;
        $agent1->setContact("95464156");
        $agent1->setMatricule(5487);
        $agent1->setNom("NATA Ana");
        $agent1->setDirection($direction1);
        $agent1->setService($service5);
        $agent1->setFonction("Secrétaire de direction");
        $agent1->setSexe("0");
        $agent1->setContact($faker->e164PhoneNumber);
        $manager->persist($agent1);
        $manager->flush();

        for($i=0;$i<249;$i++){
            
             $agents = $manager->getRepository(Agent::class)->findAll();//findBy(['<>','fonction', 'Secrétaire de direction']);
             $secretaries = $manager->getRepository(Agent::class)->findBy(['fonction' => 'Secrétaire de direction']);

             $mission=new Mission;
             $mission->setAgent($faker->randomElement($agents));
             $mission->setNoteService($faker->numberBetween($min = 1000, $max = 9999));
             $mission->setLieu($faker->streetAddress());
             $mission->setDateDepart($faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'));
             $mission->setDateRetour($faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'));
             $mission->setNbjrs(($mission->getDateRetour()->diff($mission->getDateDepart()))->days +1);
             $mission->setTypeMission("0");
             $mission->setObjet($faker->text($maxNbChars = 200));
             $mission->setPrimeChef($faker->numberBetween($min = 0, $max = 10000000));
             $mission->setCreatedAt(new \DateTime());
             $mission->setMoyen("0");
             $mission->setSavedBy(($faker->randomElement($secretaries))->getNom());
             $mission->setTraitement(false);
             $manager->persist($mission);
             $manager->flush();
        }
         
         $materiel1=new Materiel;
         $materiel1->setLibelle('Ordinateur portable');
         $manager->persist($materiel1);

         $materiel2=new Materiel;
         $materiel2->setLibelle('Table bureau');
         $manager->persist($materiel2);

         $materiel3=new Materiel;
         $materiel3->setLibelle('Papier toilette');
         $manager->persist($materiel3);
         
         $mats=[$materiel1,$materiel2,$materiel3];
         
        for($i=0;$i<30;$i++){
            $agents = $manager->getRepository(Agent::class)->findAll();//findBy(['<>','fonction', 'Secrétaire de direction']);   
            $affectation=new AffectationMateriel;
            $affectation->setDateAffectation(new \DateTime());
            $affectation->setMateriel($faker->randomElement($mats));
            $affectation->setAgent($faker->randomElement($agents));  
            if($affectation->getMateriel() != $materiel3) $affectation->setCode('AF'.mt_rand(02,999).'/2021/'.mt_rand(02,999));  
            $affectation->getMateriel() == $materiel3 ? $affectation->setQte(mt_rand(1,30)) : $affectation->setQte(1);
            $affectation->setAffectedBy($agent1->getNom());

            $manager->persist($affectation);  
        }

        for($i=0;$i<30;$i++){
            $appro=new ApproMateriel;
            $appro->setMateriel($faker->randomElement($mats));
            $appro->setDateAppro($faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')) ;
            $appro->setQte(mt_rand(5,10));    
            $appro->setReceivedBy('NATA Abiba');
            $manager->persist($appro);        
        }   
        $manager->flush();
        
    }
}