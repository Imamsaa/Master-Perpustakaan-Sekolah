<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Peminjaman extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Peminjaman Buku'
        ];
        return view('admin/peminjaman/index', $data);
    }

    public function tambah(): string
    {
        // $data = [
        //     'title' => 'Tambah Buku'
        // ];
        // return view('admin/buku/addbuku', $data);
    }

    public function ubah(): string
    {
        // $data = [
        //     'title' => 'Ubah Buku'
        // ];
        // return view('admin/buku/editbuku', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
