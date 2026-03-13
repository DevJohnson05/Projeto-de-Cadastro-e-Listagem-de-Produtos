<?php
require_once "../bootstrap.php";

use app\core\Router;

    $rotas_get = $routes['get'];
    $rotas_post = $routes['post'];

    $routes = new Router();

    foreach ($rotas_get as $rota => $controller) {
        $routes->add("get",$rota, $controller);
    }
    
    foreach ($rotas_post as $rota => $controller) {
        $routes->add("post",$rota, $controller);
    }
    
    $routes->dispatch();

