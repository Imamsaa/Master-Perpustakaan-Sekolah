<?php

namespace App\Controllers;

class Pengembalian extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Pengembalian',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus
        ];
        return view('pages/pengembalian',$data);
    }
}
