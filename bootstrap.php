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
    $file = 'private/'.$class . '.php';
    if (file_exists($file)) {
        include $file;
    }
});

spl_autoload_register(function ($class){
    $file = 'private/models/'.$class . '.php';
    if (file_exists($file)) {
        include $file;
    }
});

spl_autoload_register(function ($class){
    $file = 'private/controllers/'.$class . '.php';
    if (file_exists($file)) {
        include $file;
    }
});

spl_autoload_register(function ($class){
    $file = 'private/util/'.$class . '.php';
    if (file_exists($file)) {
        include $file;
    }
});