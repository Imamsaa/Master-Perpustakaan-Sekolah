<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Email extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Atur Pesan Email'
        ];
        return view('admin/email/index', $data);
    }
}
