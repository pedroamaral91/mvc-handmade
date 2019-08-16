<?php

namespace App\Controllers;

use Core\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $this->renderView('home/index', 'layout');
    }
}
