<?php

namespace App\Controllers;
use \App\Models\UsersModel;

class Login extends BaseController
{
    protected $usersModel;

    function __construct()
    {
        $this->userModel = new UsersModel();    
    }

    public function index()
    {
        session();
        $data = [
            'title' => 'Login Pustakawan',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus
        ];
        return view('pages/login',$data);
    }

    function setLogin()
    {
        $setlogin = $this->request->getvar();
        $user = $this->userModel->where('email_user',$setlogin['email_user'])->first();
        if ($this->userModel->where('email_user',$setlogin['email_user'])->countAllResults() >= 1) {
            if (password_verify($setlogin['password'],$user['password'])) {
                session()->set('user',$user);
                session()->set('login',true);
                session()->setFlashdata('kotakok',[
                    'status' => 'success',
                    'title' => 'Login Berhasil',
                    'message' => 'Selamat Datang '
                ]);
                return redirect()->to(base_url('pustakawan'));
            }else{
                session()->setFlashdata('kotakok',[
                    'status' => 'error',
                    'title' => 'Login Gagal',
                    'message' => 'Password Yang Anda Masukan Salah'
                ]);
                return redirect()->to(base_url('login'))->withInput();
            }
        }else{
            session()->setFlashdata('kotakok',[
                'status' => 'error',
                'title' => 'Login Gagal',
                'message' => 'Email Tidak Ditemukan'
            ]);
            return redirect()->to(base_url('login'))->withInput();
        }
    }
}
