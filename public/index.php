<?php
date_default_timezone_set("PRC");
define('ROOT',__DIR__.'/../');

require(ROOT.'libs/'.'functions.php');

function auto($class)
{
    $path = str_replace('\\','/',$class);
    require(ROOT.$path.'.php');
}

spl_autoload_register("auto");

$controller = 'controllers\IndexController';
$action = 'index';
if(isset($_SERVER['PATH_INFO'])&&$_SERVER['PATH_INFO'])
{
    $pathInfo = $_SERVER['PATH_INFO'];
    $pathInfo = explode('/',$pathInfo);
    $controller = '\controllers\\'.ucfirst($pathInfo[1]).'Controller';
    $action = $pathInfo[2];
}

$C = new $controller;
$C->$action();

?>