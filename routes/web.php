<?php

/** @var \Laravel\Lumen\Routing\Router $router */



$router->get('/', ['middleware' => 'firebase:role:admin', function () use ($router){
    return $router->app->version();
}]);

$router->get('/test', function () use ($router){
    return $router->app->version();
});


