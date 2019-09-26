<?php

namespace App\Service\Avatar;
use App\Service\Tools\ColorTools;

class SvgAvatarFactory{

    static public function getAvatar(int $nbColors, int $size)
    {
        $colors = ColorTools::getRandomColors($nbColors);

        $matrix = new AvatarMatrix;
        $matrix->setSize($size);
        $matrix->setColors($colors);

        $svgRenderer = new SvgAvatarRenderer('template/avatar.svg.tpl');

        return $svgRenderer->render($matrix);
    }
}
