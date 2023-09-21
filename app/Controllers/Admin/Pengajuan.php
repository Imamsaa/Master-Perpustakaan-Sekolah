<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pengajuan extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Pengajuan Pengguna'
        ];
        return view('admin/pengajuan/index', $data);
    }

    // public function tambah(): string
    // {
    //     $data = [
    //         'title' => 'Tambah Pustakawan'
    //     ];
    //     return view('admin/users/adduser', $data);
    // }

    // public function ubah(): string
    // {
    //     $data = [
    //         'title' => 'Ubah Pustakawan'
    //     ];
    //     return view('admin/users/edituser', $data);
    // }

    // public function hapus()
    // {
    //     // isi kode disini
    // }
}
