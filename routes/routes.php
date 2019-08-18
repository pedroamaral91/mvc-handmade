<?php

$routes[] = ['/', 'HomeController@index'];
$routes[] = ['/user/store', 'UserController@store'];
$routes[] = ['/user/create', 'UserController@create'];
return $routes;
