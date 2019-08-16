<?php

namespace Core;


abstract class BaseController
{
    protected $view;
    private $viewPath;
    private $layoutPath;
    public function __construct()
    {
        $this->view = new \stdClass;
    }

    public function renderView($path, $layout = null)
    {
        $this->viewPath = $path;
        if ($layout) {
            $this->layoutPath = $layout;
            return $this->layout();
        }
        return $this->content();
    }

    public function content()
    {
        $file = __DIR__ . "/../app/Views/{$this->viewPath}.php";
        if (file_exists($file)) {
            return require_once $file;
        }
        return $this->errorView();
    }

    public function layout()
    {
        $file = __DIR__ . "/../app/Views/{$this->layoutPath}.php";
        if (file_exists($file)) {
            return require_once $file;
        }
        return $this->errorView();
    }

    public function errorView()
    {
        echo "404 NOT FOUND";
    }
}
