<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pengajuan extends BaseController
{
    public function index()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Daftar Pengajuan Pengguna',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/pengajuan/index', $data);
    }

    // public function tambah()
    // {
    //     $data = [
    //         'title' => 'Tambah Pustakawan'
    //     ];
    //     return view('admin/users/adduser', $data);
    // }

    // public function ubah()
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
