<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Denda extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Denda'
        ];
        return view('admin/denda/tabledenda', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Denda'
        ];
        return view('admin/denda/adddenda', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Denda'
        ];
        return view('admin/denda/editdenda', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
