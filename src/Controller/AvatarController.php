<?php
namespace App\Controller;

use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AvatarController extends AbstractController{

    private $svgAvatarFactory;
    private $fileSystemHelper;

    public function __construct(SvgAvatarFactory $svgAvatarFactory,FileSystemHelper $fileSystemHelper)
    {
        $this->svgAvatarFactory=$svgAvatarFactory;
        $this->fileSystemHelper=$fileSystemHelper;
    }

    /**
     * @Route("/avatar",name="avatar.create")
     */
    public function create($uploadDir){
        $svg=$this->svgAvatarFactory->getAvatar(2,5);
        $filename = sha1(uniqid(rand(),true)).'.svg';
        $filePath = $uploadDir.'/'.SvgAvatarFactory::AVATAR_DIR.'/'.$filename;
        $this->fileSystemHelper->write($filePath,$svg);

        return $this->render('avatar.html.twig',[
            'filename'=>$filename
        ]);

    }
}