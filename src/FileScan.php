<?php


namespace Siam\Annotation;


class FileScan
{
    protected $return_list = [];

    public function start($scan_path)
    {
        if ($dh = opendir($scan_path)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != '.' && $file != '..') {
                    if (!is_dir($scan_path  . $file)) {
                        $file_path = $scan_path .  $file;
                        if(pathinfo($file_path, PATHINFO_EXTENSION )=='php'){
                            $this->return_list[] = $file_path;
                        }
                    } else {
                        $new_base_dir = $scan_path  . $file . DIRECTORY_SEPARATOR;
                        $this->start($new_base_dir);
                    }
                }
            }
            closedir($dh);
        }
        return $this->return_list;
    }
}