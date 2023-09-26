<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Denda extends BaseController
{
    public function index()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Daftar Denda',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/denda/tabledenda', $data);
    }

    public function tambah()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Tambah Denda',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/denda/adddenda', $data);
    }

    public function ubah()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Ubah Denda',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/denda/editdenda', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
