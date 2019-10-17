<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PromotionFixtures extends BaseFixtures implements DependentFixtureInterface
{

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return[
            DegreeFixtures::class,
            YearFixtures::class
        ];

    }

    public function load(ObjectManager $manager)
    {

        $degrees = $this->getReferences('Degree');
        $years = $this->getReferences('Year');
        $count = 0;


        foreach ($degrees as $degree){
            foreach ($years as $year){
            $promo = new Promotion();
            $promo->setDegree($degree);
            $promo->setYear($year);
            $manager->persist($promo);
            $this->addReference('Promotion_'.$count,$promo);
            $count++;
            }
        }

        $manager->flush();

    }
}
