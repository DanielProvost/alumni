<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use DateTime;

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
        $notes = '';
        $count = 0;
        $faker = Factory::create('fr_FR');

        foreach ($degrees as $degree){
            foreach ($years as $year){
            $promo = new Promotion();
            $promo->setDegree($degree);
            $promo->setYear($year);
            $promo->setStartDate(new DateTime(rand(2000,2017).'-'.$faker->month.'-'.$faker->dayOfMonth));
            $promo->setEndDate(new DateTime(rand(2018,2019).'-'.$faker->month.'-'.$faker->dayOfMonth));
            $promo->setNotes($notes);
            $manager->persist($promo);
            $this->addReference('Promotion_'.$count,$promo);
            $count++;
            }
        }

        $manager->flush();

    }
}
