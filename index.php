<?php
//on définit notre autoloader pour l'instanciation des objets
require_once('autoload.php');

// on va créer notre controller
$app = new Controller\Controller;

// on lance notre application web
$app->run();



// code thibault
// <?php

// // monsite.fr?action=accueil

// $page = $_GET['action'];

// $db = new EntityRepository();

// switch($page) {
//     case 'accueil': 
//         $controller = new AccueilController($db);
//         break;
//     case 'admin-user':
//         $controller = new AdminUserController($db);
//         break;
// } 

// $controller->run();