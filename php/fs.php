<?php
    //remove folder
    function dir_remove($path) {
        if (is_file($path)) 
            return unlink($path);
        if (is_dir($path)) {
            foreach(scandir($path) as $p) if (($p!='.') && ($p!='..'))
                dir_remove($path.DIRECTORY_SEPARATOR.$p);
            return rmdir($path); 
        }
        return false;
    }
    //copy files
    function dir_copy($from, $to) {
        if (is_dir($from)) {
            @mkdir($to);
            $d = dir($from);
            while (false !== ($entry = $d->read())) {
                if ($entry == "." || $entry == "..") 
                    continue;
                my_copy_all("$from/$entry", "$to/$entry");
            }
            $d->close();
        }
        else 
            copy($from, $to);
    }


    
    