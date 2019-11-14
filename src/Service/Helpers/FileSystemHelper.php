<?php

namespace App\Service\Helpers;

class FileSystemHelper{

    public function checkAndCreateFolder(string $path)
    {

        if (!is_dir($path)) {
            mkdir($path, 755, true);
        }
    }


    public function write(string $path,string $content)
    {
        $folders=substr($path,0,strrpos($path,'/'));
        $this->checkAndCreateFolder($folders);
        $file=fopen($path,'w');
        fwrite($file,$content);
        fclose($file);
    }

}