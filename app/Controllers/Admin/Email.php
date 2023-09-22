<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EmailModel;

class Email extends BaseController
{
    protected $emailModel;

    function __construct()
    {
        $this->emailModel = new EmailModel();    
    }

    public function index(): string
    {
        session();
        $email = $this->emailModel->first();
        $data = [
            'title' => 'Atur Pesan Email',
            'email' => $email
        ];
        return view('admin/email/index', $data);
    }

    function save()
    {
        $email = $this->request->getVar();
        if ($this->emailModel->where('id',1)->set([
            'smtp'  => $email['smtp'],
            'email' =>  $email['email'],
            'password_email'    => $email['password_email'],
            'port'  => $email['port'],
            'nama'  => $email['nama'],
            'subject' => $email['subject'],
            'message' => $email['message']
        ])->update() == true) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   =>  'Pengaturan Email Berhasil diubah'
            ]);
            return redirect()->to(base_url('pustakawan/email'));
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   =>  'Pengaturan Email Gagal diubah'
            ]);
            return redirect()->to(base_url('pustakawan/email'))->withInput();    
        }
    }
}
