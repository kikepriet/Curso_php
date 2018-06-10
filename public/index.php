<?php

//iniciar modo estricto de errores en php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //llamamos el autoload para usar las clases de phroute sin cargar nada más
    require_once '../vendor/autoload.php';
    include_once '../config.php';

    //Obtenemos el directorio base
    $baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
    $baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
    define('BASE_URL', $baseUrl);     //guardamos todo en una constante
    
    $route = $_GET['route'] ?? '/';

    function render($fileName, $params = []){
        ob_start();
        extract($params);
        include $fileName;
        return ob_get_clean();
    }

    //Aqui usamos el rute collector para organizar nuestras rutas
    use Phroute\Phroute\RouteCollector;

    $router = new RouteCollector();

    $router->controller('/admin', App\Controllers\Admin\IndexController::class);
    $router->controller('/admin/posts', App\Controllers\Admin\PostController::class);
    $router->controller('/', App\Controllers\IndexController::class);

    //usando el dispatcher
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

    //ponemos la respuesta del dispatcher
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

    echo $response;
?>