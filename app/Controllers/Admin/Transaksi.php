<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettransaksiModel;

class Transaksi extends BaseController
{
    protected $settransModel;

    function __construct()
    {
        $this->settransModel = new SettransaksiModel();    
    }

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $set = $this->settransModel->first();
        $data = [
            'title' => 'Pengaturan Transaksi',
            'set' => $set,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/transaksi/index', $data);
    }

    function update()
    {
        $set = $this->request->getVar();
        // dd($set);
        if ($this->settransModel->where('id',1)->set([
            'terlambat'   => $set['terlambat'],
            'denda' => $set['denda']
        ])->update() == true
        ) {
            session()->setFlashdata('kotaktime',[
                'status'    => 'success',
                'title' => 'Berhasil',
                'message'   => 'Data Berhasil Di Ubah'
            ]);
            return redirect()->to(base_url('pustakawan/transaksi'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Data Gagal Di Ubah'
            ]);
            return redirect()->to(base_url('pustakawan/transaksi'))->withInput();
        }
    }
}
