<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Pustakawan'
        ];
        return view('admin/users/tableuser', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Pustakawan'
        ];
        return view('admin/users/adduser', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Pustakawan'
        ];
        return view('admin/users/edituser', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
