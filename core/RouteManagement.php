<?php

namespace Core;

class RouteManagement
{
    private $routes;
    public function __construct(array $routes)
    {
        $this->setRoutes($routes);
        $this->run();
    }

    private function setRoutes(array $routes)
    {
        foreach ($routes as $route) {
            $controllerMethod = explode('@', $route[1]);
            $this->routes[] = [$route[0], $controllerMethod[0], $controllerMethod[1]];
        }
    }

    private function getRequest()
    {
        $object = new \stdClass;
        foreach ($_GET as $key => $value) {
            $object->get->$key = $value;
        }
        foreach ($_POST as $key => $value) {
            $object->post->$key = $value;
        }
        return $object;
    }

    private function getIncomingUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function run()
    {
        $url = $this->getIncomingUrl();
        foreach ($this->routes as $route) {
            $this->generateURL($route, $url);
        }
    }

    private function generateURL(array $route, string $url)
    {
        $routeURL = explode("/", $route[0]);
        $urlArray = explode("/", $url);
        $param = [];
        for ($i = 0; $i < count($routeURL); $i++) {
            if ((strpos($routeURL[$i], '{') !== false) && (count($routeURL) === count($urlArray))) {
                $routeURL[$i] = $urlArray[$i];
                $param[] = $urlArray[$i];
            }
            $route[0] = implode('/', $routeURL);
        }
        if ($url === $route[0]) {
            $controller = Container::newController($route[1]);
            return $this->instantiateController($controller, $param, $route[2]);
        }
        return $this->routeNotFound();
    }

    private function instantiateController($controller, array $param, $action)
    {
        switch (count($param)) {
            case 1:
                return $controller->$action($param[0], $this->getRequest());
            case 2:
                return $controller->$action($param[0], $param[1], $this->getRequest());
            case 3:
                return $controller->$action($param[0], $param[1], $param[2], $this->getRequest());
            default:
                return $controller->$action($this->getRequest());
        }
    }

    private function routeNotFound()
    {
        $port = $_SERVER['SERVER_PORT'];
        // header("Location: http://localhost:$port/404");
        Container::routeNotFound();
        // die();
    }
}
