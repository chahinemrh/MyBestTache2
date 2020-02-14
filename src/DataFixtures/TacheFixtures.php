<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Taches;

class TacheFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=1; $i <= 12; $i++){
            $tache= new Taches(); 
            $tache->setTitre("Tâche numéro $i")
                 ->setDescription("<p> Description de la tâche n° $i")
                 ->setStatut("<p> La tache n°$i est à faire")
                 ->setDateCreation(new \DateTime () );
            $manager -> persist($tache);
        }

        $manager->flush();
    }
}
