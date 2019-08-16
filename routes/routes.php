<?php

$routes[] = ['/', 'HomeController@index'];
$routes[] = ['/user', 'UserController@index'];
$routes[] = ['/user/store', 'UserController@store'];
return $routes;
