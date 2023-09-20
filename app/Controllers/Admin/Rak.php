<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Rak extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Rak Buku'
        ];
        return view('admin/rak/tablerak', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Rak Buku'
        ];
        return view('admin/rak/addrak', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Rak Buku'
        ];
        return view('admin/rak/editrak', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
