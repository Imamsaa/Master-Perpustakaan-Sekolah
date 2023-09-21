<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class WhastApp extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Atur Pesan WhastApp'
        ];
        return view('admin/whastapp/index', $data);
    }
}
