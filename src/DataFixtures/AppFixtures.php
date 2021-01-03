<?php

namespace App\DataFixtures;

use App\Entity\Direction;
use App\Entity\Mission;
use App\Entity\ParcAuto;
use Faker;
use App\Entity\Personnel;
use App\Entity\Service;
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

            $service3=new Service;
            $service3->setLibelle("Service commercial");
            $service3->setDirection($direction3);
            $manager->persist($service3);
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

        
        // for($i=0;$i<20;$i++){

        //     $mission=new Mission();
        //     $mission->setChefMission("");
        //     $mission->setConducteur("");
        //     $mission->setLieu($faker->catchPhrase());
        //     $mission->setMoyen("Voiture");
        //     $mission->setPrimeChef($faker->numberBetween($min = 0, $max = 10000000));
        //     $manager->persist($vehicule);
        //     $manager->flush();
        // } 
    }
}
