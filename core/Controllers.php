<?php
namespace panda\core;

class Controllers {

    public function views($view, $params = []){
        return Application::$app->router->renderView($view, $params);
    }
}