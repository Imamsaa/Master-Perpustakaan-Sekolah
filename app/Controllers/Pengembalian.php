<?php

namespace App\Controllers;

class Pengembalian extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Pengembalian'
        ];
        return view('pages/pengembalian',$data);
    }
}
