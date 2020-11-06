<?php

class Autoload{

    //méthode : auutoloader
    public static function inclusionAuto($className){
        // si y'a :new Controller\Controller  => Controller/controller.php
        $path = str_replace('\\','/',$className) . '.php';
        require $path;

    }
}

// Déclaration de l'autoloader
spl_autoload_register(array('Autoload','inclusionAuto'));
//Atention la méthode doit être STATIC



