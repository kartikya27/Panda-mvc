<?php

require_once __DIR__.'/../vendor/autoload.php';

use panda\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', function(){
    return "Hrllo";
});

$app->router->get('/about', 'about');

$app->run();
