<?php

require_once __DIR__.'/../vendor/autoload.php';

use panda\core\Application;
use panda\controllers\BaseController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', function(){
    return "Hrllo";
});

$app->router->get('/about', 'about');
$app->router->get('/contact', [BaseController::class,'show']);
$app->router->post('/contact', [BaseController::class,'store']);

$app->run();
