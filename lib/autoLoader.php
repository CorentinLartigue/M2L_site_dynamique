<?php
spl_autoload_register('Autoloader::autoloadDto');
spl_autoload_register('Autoloader::autoloadDao');
spl_autoload_register('Autoloader::autoloadLib');
spl_autoload_register('Autoloader::autoloadTraits');


class Autoloader{
    
    static function autoloadDto($class){
        $file = 'modeles/dto/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
      
    }
    
    static function autoloadLib($class){
        $file = 'lib/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
        
    }
    
    static function autoloadDao($class){
        $file = 'modeles/dao/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
        
    }
    static function autoloadTraits($class){
        $file = 'modeles/traits/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }

    }
    
}


