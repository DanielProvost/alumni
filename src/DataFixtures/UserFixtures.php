<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixtures implements DependentFixtureInterface
{
    /**
     * @var SvgAvatarFactory
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    private $svgAvatarFactory;
    private $fileSystemHelper;
    private $upload_path;

    /**
     * UserFixtures constructor.
     * @param SvgAvatarFactory $svgAvatarFactory
     * @param FileSystemHelper $fileSystemHelper
     * @param $upload_path
     */

    public function __construct(SvgAvatarFactory $svgAvatarFactory,FileSystemHelper $fileSystemHelper,UserPasswordEncoderInterface $passwordEncoder, $upload_path)
    {
        parent::__construct();
        $this->svgAvatarFactory=$svgAvatarFactory;
        $this->fileSystemHelper=$fileSystemHelper;
        $this->upload_path = $upload_path;
        $this->passwordEncoder = $passwordEncoder;
    }


    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return[
           PromotionFixtures::class
        ];

    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i=0;$i<200;$i++){
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($this->passwordEncoder->encodePassword($user,'user'));
            $user->setCity($faker->city);
            $user->setBirthdate(new DateTime(rand(1950,2000).'-'.$faker->month.'-'.$faker->dayOfMonth));
            $promotions = $this->getReferences('Promotion');
            $promos = $faker->randomElements($promotions,rand(1,2));
            foreach($promos as $promo){
                $user->addPromotion($promo);
            }
            $filename = $this->getAvatar();
            $user->setAvatar($filename);
            $manager->persist($user);
        }
        $admin = new User();
        $admin->setFirstname('Daniel');
        $admin->setLastname('Provost');
        $admin->setEmail('dprovost67@gmail.com');
        $passwordHashed = $this->passwordEncoder->encodePassword($admin,'admin');
        $admin->setPassword($passwordHashed);
        $admin->setCity('Aix-en-Provence');

        $user->setBirthdate(new DateTime('1975-02-14'));
        $admin->setAvatar($this->getAvatar());
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();
    }

    public function getAvatar(){
        $svg=$this->svgAvatarFactory->getAvatar(2,5);
        $filename = sha1(uniqid(rand(),true)).'.svg';
        $filePath = $this->upload_path.'/'.SvgAvatarFactory::AVATAR_DIR.'/'.$filename;
        $this->fileSystemHelper->write($filePath,$svg);
        return $filename;
    }

}
