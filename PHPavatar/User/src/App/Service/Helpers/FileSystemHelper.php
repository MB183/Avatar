<?php

namespace App\Service\Helpers;

class FileSystemHelper{
    public function write(string $path, string $content){
        $folders = substr($path, 0, strrpos($path, '/'));

         $this->checkAndCreatePath($folders);

        $file = fopen($path, 'w');
        fwrite($file, $content);
        fclose($file);
    }

    public function checkAndCreatePath(string $path){
        if(! is_dir($path)){
            mkdir($path, 755, true);
        }
    }
}