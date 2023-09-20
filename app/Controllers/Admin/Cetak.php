<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Cetak extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Cetak Kartu Siswa'
        ];
        return view('admin/cetak/tablecetakkelas', $data);
    }

    public function cetak(): string
    {
        $data = [
            'title' => 'Cetak Kartu Siswa'
        ];
        return view('admin/cetak/cetakkartu', $data);
    }

    public function buku(): string
    {
        $data = [
            'title' => 'Daftar Barcode Buku'
        ];
        return view('admin/cetak/tablebarcode', $data);
    }

    public function barcode(): string
    {
        $data = [
            'title' => 'Cetak Barcode Buku'
        ];
        return view('admin/cetak/cetakbarcode', $data);
    }
}
