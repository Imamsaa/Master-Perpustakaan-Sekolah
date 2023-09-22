<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JenisModel;

class Jenis extends BaseController
{
    protected $jenisModel;

    function __construct()
    {
        $this->jenisModel = new JenisModel();    
    }

    public function index(): string
    {
        session();
        $jenis = $this->jenisModel->findAll();
        $data = [
            'title' => 'Daftar Janis Buku',
            'jenis' => $jenis
        ];
        return view('admin/jenis/tablejenis', $data);
    }

    public function tambah(): string
    {
        session();
        $data = [
            'title' => 'Tambah Jenis Buku'
        ];
        return view('admin/jenis/addjenis', $data);
    }

    function save()
    {
        if ($this->jenisModel->save($this->request->getVar()) == true) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Data Jenis Buku Berhasil Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/jenis'));
        }elseif (!$this->validate($this->jenisModel->getvalidationRules())) {
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('pustakawan/jenis/tambah'))->withInput();
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Data Jenis Buku Gagal Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/jenis/tambah'))->withInput();
        }
    }

    public function ubah($kode_jenis): string
    {
        session();
        $jenis = $this->jenisModel->where('kode_jenis',$kode_jenis)->first();
        $data = [
            'title' => 'Ubah Jenis Buku',
            'jenis' => $jenis
        ];
        return view('admin/jenis/editjenis', $data);
    }

    function update()
    {
        $jenis = $this->request->getVar();
        if ($this->jenisModel->where('kode_jenis', $jenis['kode_jenis'])->set([
            'nama_jenis'    => $jenis['nama_jenis'],
            'kode_warna'    => $jenis['kode_warna']
        ])->update() == true
        ) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Data Jenis buku berhasil diubah'
            ]);
            return redirect()->to(base_url('pustakawan/jenis'));
        }elseif(!$this->validate($this->jenisModel->getvalidationRules())){
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to(base_url('pustakawan/jenis/ubah/'.$jenis['kode_jenis']))->withInput();
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Data Jenis buku gagal diubah'
            ]);
            return redirect()->to(base_url('pustakawan/jenis/ubah/'.$jenis['kode_jenis']))->withInput();
        }
    }

    public function delete($kode_jenis)
    {
        if ($this->jenisModel->where('kode_jenis',$kode_jenis)->delete() == true) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Data Jenis Buku Berhasi Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/jenis'));
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Data Jenis Buku Gagal Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/jenis'));
        }
    }
}
