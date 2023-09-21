<?php

namespace App\Controllers;

class register extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Pustakawan'
        ];
        return view('pages/register', $data);
    }
}
