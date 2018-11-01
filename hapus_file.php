<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 
$folder = "uploads/";
    if (is_dir($folder))
    {
            if ($open = opendir($folder))
            {   
                while (($file=readdir($open))!== FALSE) 
                {
                  unlink($folder.$file);
                }
            }
    }


?>