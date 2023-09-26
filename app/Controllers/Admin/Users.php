<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\LevelsModel;

class Users extends BaseController
{
    protected $usersModel;
    protected $levelsModel;

    function __construct()
    {
        $this->levelsModel = new LevelsModel();
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
        session();
        $levels = $this->levelsModel->findAll();
        $data = [
            'title' => 'Tambah Pustakawan',
            'levels' => $levels
        ];
        return view('admin/users/adduser', $data);
    }

    function save()
    {
        $validate = [
            'email_user' => [
                'rules' => 'is_unique[users.email_user]',
                'errors' => [
                    'is_unique' => 'Email Sudah Digunakan'
                ],
            ],
            'foto_user' => [
                'rules' => 'max_size[foto_user,1024]|ext_in[foto_user,png,jpg,jpeg]|is_image[foto_user]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'Moson Masukan file Gambar',
                    'is_image' => 'Moson Masukan file Gambar Yang benar'
                ],
            ],
        ];

        if (!$this->validate($validate)) {
            dd($this->validator->getErrors());
            // session()->setFlashdata('errors',$this->validator);
            // return redirect()->to(base_url('pustakawan/siswa/tambah'))->withInput();
        }

        $foto = $this->request->getFile('foto_user');

        if ($foto->getError() == 4 ) {
            $name = "pustakawan_default.jpg";
        }else{
            $name = $foto->getRandomName();
        }
        // $siswa = $this->request->getvar();
        $user = $this->request->getVar();

        
        $password = password_hash($user['password'],PASSWORD_BCRYPT);
        
        if ($this->usersModel->save([
            'nama_user' => $user['nama_user'],
            'password' => $password,
            'nomor_wa' => $user['nomor_wa'],
            'email_user' => $user['email_user'],
            'id_level' => $user['id_level'],
            'alamat_user' => $user['alamat_user'],
            'foto_user' => $name
        ]) == true
        ) {
            if ($foto->isvalid() && !$foto->hasMoved()) {
                $foto->move('admin/img/pustakawan/',$name);
            }
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Data User Berhasil disimpan'
            ]);
            return redirect()->to(base_url('pustakawan/user'));
        }else{
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Data User Gagal disimpan'
            ]);
            return redirect()->to(base_url('pustakawan/user/tambah'))->withInput();
        }
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
