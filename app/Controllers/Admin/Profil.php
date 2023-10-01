<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Profil extends BaseController
{
    protected $userModel;

    public function __construct() {
        $this->userModel = new UsersModel();
    }

    public function index()
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

    public function update()
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

        $user = $this->request->getVar();
        $userlama = $this->userModel->where('id_user',$user['id_user'])->first();
        $semua = $this->userModel->findAll();

        if (!$this->validate($validate)) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Perhatian',
                'message' => $this->validator->getError('foto_user')
            ]);
            return redirect()->to(base_url('pustakawan/profil'))->withInput();
        }

        $foto = $this->request->getFile('foto_user');

        if ($foto->getError() == 4 ) {
            $name = $userlama['foto_user'];
        }else{
            $name = $foto->getRandomName();
        }

        if ($user['email_user'] != $userlama['email_user']) {
            foreach ($semua as $s) {
                if ($user['email_user'] != $s['email_user']) {
                    $email = $user['email_user'];
                }else{
                    session()->setFlashdata('kotakok',[
                        'status' => 'error',
                        'title' => 'Gagal',
                        'message' => 'Email Sudah terdaftar'
                    ]);
                    return redirect()->to(base_url('pustakawan/profil'))->withInput();
                }
            }
        }else{
            $email = $user['email_user'];
        }

        if ($this->userModel->where('id_user',$user['id_user'])->set([
            'nama_user' => $user['nama_user'],
            'nomor_wa' => $user['nomor_wa'],
            'email_user' => $email,
            'alamat_user' => $user['alamat_user'],
            'foto_user' => $name
        ])->update() == true) {
            if ($foto->getError() == 4 ) {
                
            }else{
                if ($foto->isvalid() && !$foto->hasMoved()) {
                    $foto->move('admin/img/pustakawan/',$name);
                    unlink('admin/img/pustakawan/'.$userlama['foto_user']);
                }
            }
            session()->setFlashdata('kotaktime',[
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Profil Berhasil Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/profil'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status' => 'error',
                'message' => 'Profil Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/profil'))->withInput();
        }
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

    public function repassword()
    {
        $pass = $this->request->getVar();
        if (password_verify($pass['password'],$this->aku['password'])) {
            if ($pass['pw1'] == $pass['pw2']) {
                if ($this->userModel->where('id_user',$this->aku['id_user'])->set([
                    'password' => password_hash($pass['pw1'],PASSWORD_BCRYPT)
                ])->update() == true) {
                    session()->setFlashdata('kotaktime',[
                        'status' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'Password Berhasil Diubah'
                    ]);
                    return redirect()->to(base_url('pustakawan'));
                }else{
                    session()->setFlashdata('pojokatas',[
                        'status' => 'error',
                        'message' => 'Password Gagal Diubah'
                    ]);
                    return redirect()->to(base_url('pustakawan'));
                }
            }else{
                session()->setFlashdata('kotakok',[
                    'status' => 'warning',
                    'title' => 'Perhatian',
                    'message' => 'Password Yang Anda Masukan Tidak Sama'
                ]);
                return redirect()->to(base_url('pustakawan/password'));
            }
        }else{
            session()->setFlashdata('kotakok',[
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Password Salah'
            ]);
            return redirect()->to(base_url('pustakawan/password'));
        }
    }
}
