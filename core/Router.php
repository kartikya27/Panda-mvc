<?php 

namespace panda\core;

/**
 * 
 * @param \panda\core\Request $request
 * @param \panda\core\Response $response
 */

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $respones)
    {
        $this->request = $request;
        $this->Response = $respones;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath(); 
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false)
        {
            Application::$app->response->setStatusCode(404);
            return "404 Error. Page Not Found";
            exit;
        }
        if(is_string($callback))
        {
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }
    
    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{page_content}}', $viewContent, $layoutContent);
        // require_once Application::$FOLDER_PATH."/views/$view.theme.php";

    }
    
    protected function layoutContent()
    {
        ob_start();
        include_once Application::$FOLDER_PATH."/views/layouts/main.theme.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$FOLDER_PATH."/views/$view.theme.php";
        return ob_get_clean();
    }

}