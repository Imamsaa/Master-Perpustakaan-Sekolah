<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Jenis extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Janis Buku'
        ];
        return view('admin/jenis/tablejenis', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Jenis Buku'
        ];
        return view('admin/jenis/addjenis', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Jenis Buku'
        ];
        return view('admin/jenis/editjenis', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
