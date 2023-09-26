<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Dashboard Pustakawan',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/dashboard/dashboard', $data);
    }
}
