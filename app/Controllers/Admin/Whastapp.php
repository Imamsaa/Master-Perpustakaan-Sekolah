<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WhastappModel;

class WhastApp extends BaseController
{
    protected $whastappModel;

    function __construct()
    {
        $this->whastappModel = new WhastappModel();    
    }

    public function index(): string
    {
        session();
        $whastapp = $this->whastappModel->first();
        $data = [
            'title' => 'Atur Pesan WhastApp',
            'whastapp'  => $whastapp
        ];
        return view('admin/whastapp/index', $data);
    }

    function save()
    {
        $w = $this->request->getvar();
        if ($this->whastappModel->where('id', 1)->set([
            'endpoint' => $w['endpoint'],
            'pengirim'  => $w['pengirim'],
            'message'   => $w['message']
        ])->update() == true
        ) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Pengaturan WhastApp Berhasil Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/whastapp'));
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Pengaturan WhastApp Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/whastapp'))->withInput();
        }
    }
}
