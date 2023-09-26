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

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $users = $this->usersModel
        ->join('levels', 'levels.id_level = users.id_level')
        ->findAll();
        $data = [
            'title' => 'Daftar Pustakawan',
            'users' => $users,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/users/tableuser', $data);
    }

    public function tambah()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $levels = $this->levelsModel->findAll();
        $data = [
            'title' => 'Tambah Pustakawan',
            'levels' => $levels,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
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
            'username' => [
                'rules' => 'is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'Username Sudah Digunakan'
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
            // dd($this->validator->getErrors());
            session()->setFlashdata('errors',$this->validator->getErrors());
            return redirect()->to(base_url('pustakawan/user/tambah'))->withInput();
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
            'username' => $user['username'],
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

    public function ubah($username)
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $user = $this->usersModel
        ->join('levels','levels.id_level = users.id_level')
        ->where('username',$username)
        ->first();
        $level = $this->levelsModel->findAll();
        $data = [
            'title' => 'Ubah Pustakawan',
            'user' => $user,
            'level' => $level,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/users/edituser', $data);
    }

    function update()
    {
        $validate = [
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
            // dd($this->validator->getErrors());
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to(base_url('pustakawan/siswa/tambah'))->withInput();
        }

        $user = $this->request->getVar();
        $userlama = $this->usersModel
        ->where('id_user', $user['id_user'])
        ->first();
        $semuauser = $this->usersModel->findAll();
        $foto = $this->request->getFile('foto_user');

        if ($foto->getError() == 4 ) {
            $name = $userlama['foto_user'];
        }else{
            $name = $foto->getRandomName();
        }
        
        if ($user['email_user'] != $userlama['email_user']) {
            foreach ($semuauser as $semua) {
                if ($user['email_user'] != $semua['email_user']) {
                    $email = $user['email_user'];
                }else{
                    session()->setFlashdata('session',[
                        'status' => 'error',
                        'message' => 'Email Telah digunakan'
                    ]);
                    return redirect()->to(base_url('pustakawan/user/ubah/'.$userlama['username']));
                }
            }
        }else{
            $email = $user['email_user'];
        }

        if ($user['username'] != $userlama['username']) {
            foreach ($semuauser as $semua) {
                if ($user['username'] != $semua['username']) {
                    $username = $user['username'];
                }else{
                    session()->setFlashdata('session',[
                        'status' => 'error',
                        'message' => 'Username Telah digunakan'
                    ]);
                    return redirect()->to(base_url('pustakawan/user/ubah/'.$userlama['username']));
                }
            }
        }else{
            $username = $user['username'];
        }

        $password = password_hash($user['password'],PASSWORD_BCRYPT);
        
        if ($this->usersModel->where('id_user',$userlama['id_user'])->set([
            'nama_user' => $user['nama_user'],
            'username' => $username,
            'password' => $password,
            'nomor_wa' => $user['nomor_wa'],
            'email_user' => $email,
            'id_level' => $user['id_level'],
            'alamat_user' => $user['alamat_user'],
            'foto_user' => $name
        ])->update() == true
        ) {
            if ($foto->isvalid() && !$foto->hasMoved()) {
                $foto->move('admin/img/pustakawan/',$name);
                unlink('admin/img/pustakawan/'.$userlama['foto_user']);
            }
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Data User Berhasil disimpan'
            ]);
            return redirect()->to(base_url('pustakawan/user/ubah/'.$userlama['username']));
        }else{
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Data User Gagal disimpan'
            ]);
            return redirect()->to(base_url('pustakawan/user/ubah/'.$userlama['username']))->withInput();
        }
    }

    public function hapus()
    {
        // isi kode disini
    }
}
