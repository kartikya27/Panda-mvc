<?php

namespace panda\core;

class Application
{
    public static string $FOLDER_PATH;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Controller $controller;
    public function __construct($rootPath)
    {
        self::$FOLDER_PATH = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function getController():\panda\core\Controller{
        return $this->controller;
    }

    public function setController(\panda\core\Controller $controller):void{
        $this->controller = $controller;
    }
}