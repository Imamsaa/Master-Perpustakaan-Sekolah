<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Profil extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Ubah Profil'
        ];
        return view('admin/profil/index', $data);
    }

    public function password(): string
    {
        $data = [
            'title' => 'Ubah Password'
        ];
        return view('admin/profil/password', $data);
    }
}
