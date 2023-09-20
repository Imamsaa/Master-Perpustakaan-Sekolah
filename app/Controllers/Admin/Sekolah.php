<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Sekolah extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Profil Sekolah'
        ];
        return view('admin/sekolah/index', $data);
    }
}
