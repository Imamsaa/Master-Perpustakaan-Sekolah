<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Laporan Transaksi'
        ];
        return view('admin/laporan/tablelaporan', $data);
    }
}
