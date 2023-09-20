<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kelas extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Kelas'
        ];
        return view('admin/kelas/tablekelas', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Kelas'
        ];
        return view('admin/kelas/addkelas', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Kelas'
        ];
        return view('admin/kelas/editkelas', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
