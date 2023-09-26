<?php

namespace App\Controllers;

class register extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Pustakawan',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus
        ];
        return view('pages/register', $data);
    }
}