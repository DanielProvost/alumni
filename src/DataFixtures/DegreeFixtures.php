<?php

namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DegreeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $formation = ['Developpement Web et Web Mobile','WebDesigner','ElectricityManager','Immobilier et capitalisme','BTS secrétariat','Titre professionnel employe administratif et accueil'];


        foreach ($formation as $i => $form) {
            $degree = new Degree();
            $degree->setName($form);
            $this->addReference('Degree_'.$i,$degree);
            $manager->persist($degree);
        }

        $manager->flush();
    }
}
