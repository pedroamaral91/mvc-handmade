<?php

namespace App\Controllers;

use Core\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $this->renderView('user/index', 'layout');
    }

    public function store($request)
    {
        $this->view->name = $request->post->name;
        $this->renderView('/user/store', 'layout');
    }
}
