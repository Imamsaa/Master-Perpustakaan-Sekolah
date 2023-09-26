<?php

namespace App\Controllers;

class Peminjaman extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Peminjaman',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus
        ];
        return view('pages/peminjaman',$data);
    }
}
