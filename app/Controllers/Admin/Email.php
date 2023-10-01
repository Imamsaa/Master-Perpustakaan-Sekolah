<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EmailModel;
use App\Models\SelectorModel;

class Email extends BaseController
{
    protected $emailModel;
    protected $selectorModel;

    function __construct()
    {
        $this->emailModel = new EmailModel();
        $this->selectorModel = new SelectorModel();    
    }

    public function index()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        session();
        $email = $this->emailModel->first();
        // dd($email);
        $selector = $this->selectorModel->findAll();
        $data = [
            'title' => 'Atur Pesan Email',
            'email' => $email,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku,
            'selector' => $selector
        ];
        return view('admin/email/index', $data);
    }

    function save()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $email = $this->request->getVar();
        if ($this->emailModel->where('id',1)->set([
            'smtp'  => $email['smtp'],
            'email' =>  $email['email'],
            'password_email'    => $email['password_email'],
            'port'  => $email['port'],
            'nama'  => $email['nama'],
            'subject' => $email['subject'],
            'selector' => $email['selector'],
            'message' => $email['message']
        ])->update() == true) {
            session()->setFlashdata('kotaktime',[
                'status'    => 'success',
                'title' => 'Berhasil',
                'message'   =>  'Pengaturan Email Berhasil diubah'
            ]);
            return redirect()->to(base_url('pustakawan/email'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   =>  'Pengaturan Email Gagal diubah'
            ]);
            return redirect()->to(base_url('pustakawan/email'))->withInput();    
        }
    }
}
