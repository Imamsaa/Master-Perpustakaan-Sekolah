<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home Pengunjung',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus
        ];
        return view('pages/home',$data);
    }
}
