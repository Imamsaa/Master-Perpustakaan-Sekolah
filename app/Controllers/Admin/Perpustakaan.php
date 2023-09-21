<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Perpustakaan extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Profil Perpustakaan'
        ];
        return view('admin/perpustakaan/index', $data);
    }
}
