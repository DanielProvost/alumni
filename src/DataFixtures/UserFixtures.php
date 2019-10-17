<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends BaseFixtures implements DependentFixtureInterface
{
    private $svgAvatarFactory;
    private $fileSystemHelper;

    private $upload_path;


    public function __construct(SvgAvatarFactory $svgAvatarFactory,FileSystemHelper $fileSystemHelper, $upload_path)
    {
        parent::__construct();
        $this->svgAvatarFactory=$svgAvatarFactory;
        $this->fileSystemHelper=$fileSystemHelper;

        $this->upload_path = $upload_path;
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
        // $product = new Product();
        // $manager->persist($product);

            $user = new User();
            $user->setFirstname('Daniel');
            $user->setLastname('Provost');
            $user->setEmail('dprovost67@gmail.com');
            $user->setPassword(password_hash('papa1',PASSWORD_DEFAULT));
            $user->setCity('Aix-en-Provence');
            $user->setBirthdate(new DateTime('1975-02-14'));
            $promotions = $this->getReferences('Promotion');
            $promo = $promotions[rand(0,count($promotions)-1)];
            $user->addPromotion($promo);

            $svg=$this->svgAvatarFactory->getAvatar(2,5);
            $filename = sha1(uniqid(rand(),true)).'.svg';
            $filePath = $this->upload_path.'/'.SvgAvatarFactory::AVATAR_DIR.'/'.$filename;
            $this->fileSystemHelper->write($filePath,$svg);
            $user->setAvatar($filename);

            $manager->persist($user);


        $manager->flush();
    }
}
