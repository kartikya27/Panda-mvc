<?php
namespace panda\core;

class Controllers {

    public string $layout = 'master';

    public function views($view, $params = []){
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout){
        $this->layout = $layout;
    }
}