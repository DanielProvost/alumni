<?php

namespace App\Service\Avatar;

use App\Service\Tools\ColorTools;


class SvgAvatarFactory{

    const AVATAR_DIR='avatar';

    private $template;

    public function __construct($template)
    {
        $this->template=$template;
    }

    public function getAvatar(int $nbColors,int $size){

        $matrix = new AvatarMatrix();
        $matrix->setColors(ColorTools::getRandomColors($nbColors));
        $matrix->setSize($size);
        $svgAvatarRender = new SvgAvatarRenderer($this->template);
        $svg= $svgAvatarRender->render($matrix);

        return $svg;
    }
}