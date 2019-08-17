<?php

namespace Core;


abstract class BaseController
{
    protected $view;
    private $viewPath;
    private $layoutPath;
    protected $scriptsJs = [];

    public function __construct()
    {
        $this->view = new \stdClass;
    }

    protected function importJsScripts($file)
    {
        $path = "<script src='/assets/js/$file.js'></script>";
        $this->scriptsJs[] = $path;
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
            require_once $file;
            return;
        }
        return $this->errorView();
    }

    public function layout()
    {
        $file = __DIR__ . "/../app/Views/{$this->layoutPath}.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
        return $this->errorView();
    }

    public function errorView()
    {
        echo "404 NOT FOUND";
    }

    public function showScriptsJSFooter()
    {
        foreach ($this->scriptsJs as $script) {
            echo $script;
        }
    }
}
