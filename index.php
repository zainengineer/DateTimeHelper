<?php
spl_autoload_register(function($className)
{
    $baseName = basename($className);
    $path = dirname(__FILE__) . '/classes/' . $baseName . '.php';
    loadClassIfExists($baseName,$path);

});
function loadClassIfExists($className, $path)
{
    if (file_exists($path)){
        include_once($path);
    }
}

$x = new TimeHelper();
