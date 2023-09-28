<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WhastappModel;
use App\Models\SelectorModel;

class WhastApp extends BaseController
{
    protected $whastappModel;
    protected $selectorModel;

    function __construct()
    {
        $this->whastappModel = new WhastappModel();
        $this->selectorModel = new SelectorModel();    
    }

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $whastapp = $this->whastappModel->first();
        $selector = $this->selectorModel->findAll();
        $data = [
            'title' => 'Atur Pesan WhastApp',
            'whastapp'  => $whastapp,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku,
            'selector' => $selector
        ];
        return view('admin/whastapp/index', $data);
    }

    function save()
    {
        $w = $this->request->getvar();
        if ($this->whastappModel->where('id', 1)->set([
            'endpoint' => $w['endpoint'],
            'pengirim'  => $w['pengirim'],
            'message'   => $w['message'],
            'apikey'    => $w['apikey'],
            'selector' => $w['selector']
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
