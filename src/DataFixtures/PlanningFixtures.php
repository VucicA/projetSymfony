<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Intervenants;
use App\Entity\Users;
use App\Entity\Alternants;
use App\Entity\Secretaires;
use App\Entity\Matieres;

class PlanningFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
     for($i= 1; $i <=15; $i++){
            $user = new Users();
            $user->setNom("Nom n°$i")
                  ->setPrenom("Prenom n°$i")
                  ->setEmail("NomPrenom$i@test.com")
                  ->setPassword("1234");
            if ( $i<=5){
                $user->setRole("Alternant");
                $manager->persist($user);
                $manager->flush();
                $etudiant = new Alternants();
                $etudiant->setIdUsers($manager->getRepository(Users::class)->findOneBy(['email'=> $user->getEmail()]));
                $manager->persist($etudiant);
                $manager->flush();
            }
            else if ( 5 < $i && $i <= 14 ){
                $user->setRole("Intervenant");
                $manager->persist($user);
                $manager->flush();
                $intervenant = new Intervenants();
                $intervenant->setIdUsers($manager->getRepository(Users::class)->findOneBy(['email'=> $user->getEmail()]));
                $manager->persist($intervenant);
                $manager->flush();
            }else{
                $user->setRole("Secretaire");
                $manager->persist($user);
                $manager->flush();
                $secretaire = new Secretaires();
                $secretaire->setIdUsers($manager->getRepository(Users::class)->findOneBy(['email'=> $user->getEmail()]));
                $manager->persist($secretaire);
                $manager->flush();
            }

            $matiere = new Matieres();
            $matiere->setNom("Matiere $i");
            $matiere->setBackgroundColor("#000000");
            $matiere->setBorderColor("#000000");
            $matiere->setTextColor("#FFFFFF");
            $matiere->setNbHeure(30);
            $manager->persist($matiere);
            $manager->flush();
            
        }

 
    }
}
