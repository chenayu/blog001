<?php

function view($file,$data)
{
    extract($data);
    $path = str_replace('.','/',$file);
    require(ROOT.'views/'.$path.'.html');
}


?>