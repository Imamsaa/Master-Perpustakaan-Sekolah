<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Buku extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Buku'
        ];
        return view('admin/buku/tablebuku', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Buku'
        ];
        return view('admin/buku/addbuku', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Buku'
        ];
        return view('admin/buku/editbuku', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
