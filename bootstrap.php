<?php
function loader($class)
{
    $file = $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
}
spl_autoload_register('loader');

spl_autoload_register(function ($class){
    include 'private/'.$class.'.php';
});

spl_autoload_register(function ($class){
    include 'private/models/'.$class.'.php';
});

spl_autoload_register(function ($class){
    include 'private/controllers/'.$class.'.php';
});

spl_autoload_register(function ($class){
    include 'private/util/'.$class.'.php';
});