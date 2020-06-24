<?php
namespace Base;

class Route
{
    private $routes;
    private $controller;
    private $action;

    public function add(string $route, $controllerName, $actionName = 'index')
    {

        $this->routes[$route] = [$controllerName, $actionName];
    }

    public function auto($uri)
    {

        $parts = explode('/', $uri);
        if (empty($parts[1])) {
            return false;
        }
        $controllerName = $parts[1];
        $actionName = 'index';
        if (isset($parts[2])) {
            $actionName = $parts[2];
        }
        $controllerClassName = 'App\\Controller\\' . ucfirst(strtolower($controllerName));


        if (!class_exists($controllerClassName)) {
            return false;
        }

        $this->controller = new $controllerClassName();
        if (!method_exists($this->controller, $actionName)) {
            return false;
        }


        $this->action = $actionName;
        return true;
    }

    /**
     * @param string $uri
     * @throws Error404Exception
     */
    public function dispatch(string $uri)
    {

        // разбираем $uri
        $parsed = parse_url($uri);
        // выбираем пути
        $uri = $parsed['path'];
        // если мы нашли совпадение запрашиваемого uri и статического
        if (isset($this->routes[$uri])) {
            // то отдаем контроллер и экшон, соответствующий статическому
            $controllerName = $this->routes[$uri][0];
            $this->controller = new $controllerName;
            $this->action = $this->routes[$uri][1];

            return;
        }


        if (!$this->auto($uri)) {
            throw new Error404Exception();
        }
    }

    /**
     * @return mixed
     */
    public function getController()
    {

        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
}