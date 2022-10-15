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

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
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
            $this->response->setStatusCode(404);
            return $this->renderContent("404 Error. Page Not Found");
            // return $this->renderContent("_404");
            exit;
        }
        if(is_string($callback))
        {
            return $this->renderView($callback);
        }
        if(is_array($callback)){
           Application::$app->controller = new $callback[0];
           $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }
    
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{page_content}}', $viewContent, $layoutContent);
    }

    // For render content on same url is page or view not found
    public function renderContent($view)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{page_content}}', $view, $layoutContent);
    }
    
    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$FOLDER_PATH."/views/layouts/$layout.theme.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once Application::$FOLDER_PATH."/views/$view.theme.php";
        return ob_get_clean();
    }

}