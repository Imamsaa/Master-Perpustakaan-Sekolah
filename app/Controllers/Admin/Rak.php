<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RakModel;

class Rak extends BaseController
{
    protected $rakModel;

    function __construct()
    {
        $this->rakModel = new RakModel();    
    }

    public function index(): string
    {
        session();
        $rak = $this->rakModel->findAll();
        $data = [
            'title' => 'Daftar Rak Buku',
            'rak'   => $rak
        ];
        return view('admin/rak/tablerak', $data);
    }

    public function tambah(): string
    {
        session();
        $data = [
            'title' => 'Tambah Rak Buku'
        ];
        return view('admin/rak/addrak', $data);
    }

    function save()
    {
        if ($this->rakModel->save($this->request->getVar()) == true) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Rak Buku Berhasil Ditambahkan'
            ]);
            return redirect()->to('pustakawan/rak');
        }elseif(!$this->validate($this->rakModel->getvalidationRules())){
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to('pustakawan/rak/tambah')->withInput();
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Rak Buku Gagal Ditambahkan'
            ]);
            return redirect()->to('pustakawan/rak/tambah')->withInput();
        }
    }

    public function ubah($kode_rak): string
    {
        session();
        $rak = $this->rakModel->where('kode_rak',$kode_rak)->first();
        $data = [
            'title' => 'Ubah Rak Buku',
            'rak'   => $rak
        ];
        return view('admin/rak/editrak', $data);
    }

    function update()
    {
        $rak = $this->request->getVar();
        if ($this->rakModel->where('kode_rak',$rak['kode_rak'])->set([
            'nama_rak'  => $rak['nama_rak']
        ])->update() == true
        ) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Data Rak Berhasil Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/rak'));
        }elseif(!$this->validate($this->rakModel->getvalidationRules())){
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('pustakawan/rak/ubah/'.$rak['kode_rak']))->withInput();
        }else{
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Data Rak Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/rak/ubah/'.$rak['kode_rak']))->withInput();
        }
    }

    public function delete($kode_rak)
    {
        if ($this->rakModel->where('kode_rak',$kode_rak)->delete() == true) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Data Rak Buku Berhasil Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/rak'));
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Data Rak Buku l Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/rak'));
        }
    }
}
