<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Penerbit extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Penerbit'
        ];
        return view('admin/penerbit/tablepenerbit', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Penerbit'
        ];
        return view('admin/penerbit/addpenerbit', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Penerbit'
        ];
        return view('admin/penerbit/editpenerbit', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
