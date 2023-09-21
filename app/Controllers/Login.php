<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Login Pustakawan'
        ];
        return view('pages/login',$data);
    }
}
