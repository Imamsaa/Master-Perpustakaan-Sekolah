<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Cetak extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Cetak Kartu Siswa'
        ];
        return view('admin/cetak/tablecetakkelas', $data);
    }

    public function cetak(): string
    {
        $data = [
            'title' => 'Cetak Kartu Siswa'
        ];
        return view('admin/cetak/cetakkartu', $data);
    }
}
