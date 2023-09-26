<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Cetak extends BaseController
{
    public function index()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Cetak Kartu Siswa',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/cetak/tablecetakkelas', $data);
    }

    public function cetak()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Cetak Kartu Siswa',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/cetak/cetakkartu', $data);
    }

    public function buku()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Daftar Barcode Buku',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/cetak/tablebarcode', $data);
    }

    public function barcode()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Cetak Barcode Buku',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/cetak/cetakbarcode', $data);
    }
}
