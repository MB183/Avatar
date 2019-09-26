<?php

require 'vendor/autoload.php';

use App\Avatar\SvgAvatarFactory;
use App\Helpers\FileSystemHelper;
$svg = SvgAvatarFactory::getAvatar(3,7);


$filename = sha1(uniqid(rand(), true));
$fs = new FileSystemHelper();
$fs -> write('uploads/avatars/'.$filename.'.svg', $svg);



include 'templates/index.phtml';
