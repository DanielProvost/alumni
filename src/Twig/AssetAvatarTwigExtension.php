<?php

namespace App\Twig;

use App\Service\Avatar\SvgAvatarFactory;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;


class AssetAvatarTwigExtension extends AbstractExtension
{


    private $uploadDir;

    public function __construct(string $uploadDir){
        $this->uploadDir = $uploadDir;

    }

    public function getFunctions()
    {
        return [
            new TwigFunction('asset_avatar',[$this,'asset_avatar'])
        ];
    }

    public function asset_avatar(string $avatarName):string
    {
        return '/'.$this->uploadDir."/".SvgAvatarFactory::AVATAR_DIR.'/'.$avatarName;
    }
}
