<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;

    function __construct()
    {
        $this->usersModel = new UsersModel();    
    }

    public function index(): string
    {
        session();
        $users = $this->usersModel
        ->join('levels', 'levels.id_level = users.id_level')
        ->findAll();
        $data = [
            'title' => 'Daftar Pustakawan',
            'users' => $users
        ];
        return view('admin/users/tableuser', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Pustakawan'
        ];
        return view('admin/users/adduser', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Pustakawan'
        ];
        return view('admin/users/edituser', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
