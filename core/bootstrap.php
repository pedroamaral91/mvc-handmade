<?php

use Core\RouteManagement;

$routes = require_once __DIR__ . '/../routes/routes.php';

$routes = new RouteManagement($routes);
