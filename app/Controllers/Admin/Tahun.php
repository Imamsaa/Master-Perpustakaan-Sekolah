<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Tahun extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Tahun Ajaran'
        ];
        return view('admin/tahun/tabletahun', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Tahun Ajaran'
        ];
        return view('admin/tahun/addtahun', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Tahun Ajaran'
        ];
        return view('admin/tahun/edittahun', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
