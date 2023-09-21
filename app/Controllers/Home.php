<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home Pengunjung'
        ];
        return view('pages/home',$data);
    }
}
