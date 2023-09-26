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
                return redirect()->to(base_url('pustakawan'));
            }else{
                return redirect()->to(base_url('login'));
            }
        }else{
            return redirect()->to(base_url('login'));
        }
    }
}
