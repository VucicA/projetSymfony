<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Intervenants;
use App\Entity\Alternants;

class PlanningFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
     for($i= 1; $i <=10; $i++){
            $intervenant = new Intervenants();
            $intervenant->setNomIntervenant("Nom Intervenant n°$i")
                        ->setPrenomIntervenant("Prenom Intervenant n°$i")
                        ->setMailIntervenant("Mail Intervenant n°$i")
                        ->setPassword("1234");

            $etudiant = new Alternants();
            $etudiant->setNomAlternant("Nom Etudiant n°$i")
                     ->setPrenomAlternant("Prenom Etudiant n°$i")
                     ->setMailAlternant("Mail Etudiant n°$i")
                     ->setPassword("1234")
                     ->setSpecialisationAlternant("Test");

            $manager->persist($etudiant);
            $manager->persist($intervenant);
        }

        $manager->flush();
    }
}
