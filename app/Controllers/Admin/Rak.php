<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RakModel;
use App\Models\BukuModel;

class Rak extends BaseController
{
    protected $rakModel;
    protected $bukuModel;

    function __construct()
    {
        $this->rakModel = new RakModel();    
        $this->bukuModel = new BukuModel();  
    }

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $rak = $this->rakModel->findAll();
        $data = [
            'title' => 'Daftar Rak Buku',
            'rak'   => $rak,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/rak/tablerak', $data);
    }

    public function tambah()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        
        $data = [
            'title' => 'Tambah Rak Buku',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/rak/addrak', $data);
    }

    function save()
    {
        $rak = $this->request->getVar();
        if ($this->rakModel->where('kode_rak',$rak['kode_rak'])->countAllResults() > 0) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Kode Rak Buku Sudah Digunakan'
            ]);
            return redirect()->to('pustakawan/rak/tambah')->withInput();
        }
        if ($this->rakModel->save($rak) == true) {
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Rak Buku Berhasil Ditambahkan'
            ]);
            return redirect()->to('pustakawan/rak');
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Rak Buku Gagal Ditambahkan'
            ]);
            return redirect()->to('pustakawan/rak/tambah')->withInput();
        }
    }

    public function ubah($kode_rak)
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $rak = $this->rakModel->where('kode_rak',$kode_rak)->first();
        $data = [
            'title' => 'Ubah Rak Buku',
            'rak'   => $rak,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
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
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Data Rak Berhasil Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/rak'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Data Rak Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/rak/ubah/'.$rak['kode_rak']))->withInput();
        }
    }

    public function delete($kode_rak)
    {
        $this->rakModel->disableForeignKeyChecks();

        if ($this->bukuModel->where('kode_rak',$kode_rak)->countAllResults() > 0) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Rak Buku Masih Digunakan'
            ]);
            return redirect()->to(base_url('pustakawan/rak'));
        }

        if ($this->rakModel->where('kode_rak',$kode_rak)->delete() == true) {
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Data Rak Buku Berhasil Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/rak'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Data Rak Buku l Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/rak'));
        }
    }
}
