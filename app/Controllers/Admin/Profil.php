<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Profil extends BaseController
{
    public function index(): string
    {

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Ubah Profil',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/profil/index', $data);
    }

    public function password()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Ubah Password',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/profil/password', $data);
    }
}
