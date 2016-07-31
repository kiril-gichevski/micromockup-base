<?php

include_once 'src/config/router.php';
define('BASE_PATH', realpath(dirname(__FILE__)));

function myAutoload($class_name)
{
    $class_name = str_replace('\\','/',strtolower($class_name));
    $class_name = str_replace('micromockup','',strtolower($class_name));
    $file = __DIR__.'/src/'.$class_name.'.php';

    if (file_exists($file)) {
        include_once($file);
    }
}
spl_autoload_register('myAutoload');

$requestUrl = $_SERVER['REQUEST_URI'];
$requestUrlArray = explode('/', ltrim($requestUrl, '/'));

$class = 'page';
if (isset($requestUrlArray[1]) && $requestUrlArray[1] !== "") {
    $class = $requestUrlArray[1];
}

$action = "index";
if (isset($requestUrlArray[2]) && $requestUrlArray[2] !== ""){
    $action = $requestUrlArray[2];
}
$arguments = array_slice($requestUrlArray, 3);

if (isset($map[$class])) {
    $object = new $map[$class]();
    if (method_exists($object, $action)) {
        call_user_func_array(array($object,$action), $arguments);
        return;
    }
}

include_once '404.php';
