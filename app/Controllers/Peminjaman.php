<?php

namespace App\Controllers;

class Peminjaman extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Peminjaman'
        ];
        return view('pages/peminjaman',$data);
    }
}
