<?php

namespace App\Avatar;
use App\Tools\ColorTools;

class SvgAvatarFactory{

	static public function getAvatar(int $nbColors, int $size){

		$matrix = new AvatarMatrix();
		$matrix->setColors(colorTools::getRandomColors($nbColors));
		$matrix->setSize($size);

		$svgAvatarRenderer = new SvgAvatarRenderer('templates/avatar.svg.tpl');

		$svg = $svgAvatarRenderer->render($matrix);

		return $svg;

	}
}
