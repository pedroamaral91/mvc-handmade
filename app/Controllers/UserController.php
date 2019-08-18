<?php

namespace App\Controllers;

use Core\Container;
use Core\BaseController;
use Exception;

class UserController extends BaseController
{
    public function store()
    {
        $this->renderView('user/store', 'layout');
    }

    public function create($request)
    {
        try {
            $model =  Container::instanceModel("User");
            if (!$this->isValid($request->post)) {
                throw new Exception('fail');
            }
            $data = ['name' => $request->post->name, 'email' => $request->post->email];
            $model->create($data);
            echo json_encode(["success" => true, "message" => 'Request success!']);
        } catch (Exception $er) {
            echo json_encode(["success" => false, "message" => "Request failed."]);
        }
    }
    private function isValid($data)
    {
        if ($data->name === '' || $data->email === '') {
            return false;
        }
        return true;
    }
}
