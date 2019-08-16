<?php

class Autoload
{
    private $archives;
    public function __construct()
    {
        spl_autoload_register([$this, 'includeFiles']);
    }

    public function includeFiles(string $file)
    {
        $file = str_replace("\\", DIRECTORY_SEPARATOR, $file);
        $class = $this->fixPath($file);
        $class = __DIR__ . "/../{$class}.php";
        if (file_exists($class)) return require_once $class;
    }

    private function fixPath(string $file)
    {
        $path = explode('/', $file);
        $path[0] = strtolower($path[0]);
        return implode('/', $path);
    }
}

new Autoload;
