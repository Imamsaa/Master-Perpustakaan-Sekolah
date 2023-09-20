<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Siswa extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Daftar Siswa'
        ];
        return view('admin/siswa/tablesiswa', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Siswa'
        ];
        return view('admin/siswa/addsiswa', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Siswa'
        ];
        return view('admin/siswa/editsiswa', $data);
    }

    public function cetak(): string
    {
        $data = [
            'title' => 'Cetak Kartu Siswa'
        ];
        return view('admin/siswa/cetakkartu', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
