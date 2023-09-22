<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    protected $penerbitModel;

    function __construct()
    {
        $this->penerbitModel = new PenerbitModel;    
    }

    public function index(): string
    {
        session();
        $penerbit = $this->penerbitModel->findAll();

        $data = [
            'title' => 'Daftar Penerbit',
            'penerbit' => $penerbit
        ];
        return view('admin/penerbit/tablepenerbit', $data);
    }

    public function tambah(): string
    {
        session();
        $data = [
            'title' => 'Tambah Penerbit'
        ];
        return view('admin/penerbit/addpenerbit', $data);
    }

    function save()
    {
        if ($this->penerbitModel->save($this->request->getVar()) == true) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Penerbit Berhasil Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }elseif(!$this->validate($this->penerbitModel->getvalidationRules())){
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to(base_url('pustakawan/penerbit/tambah'))->withInput();
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Penerbit Gagal Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }
    }

    public function ubah($kode_penerbit): string
    {
        session();
        $penerbit = $this->penerbitModel->where('kode_penerbit',$kode_penerbit)->first();
        $data = [
            'title' => 'Ubah Penerbit',
            'penerbit' => $penerbit
        ];
        return view('admin/penerbit/editpenerbit', $data);
    }

    function update()
    {
        $penerbit = $this->request->getVar();
        if ($this->penerbitModel->where('kode_penerbit', $penerbit['kode_penerbit'])->set([
            'nama_penerbit' => $penerbit['nama_penerbit']
        ])->update() == true
        ){
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Edit Penerbit Berhasil'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }elseif(!$this->validate($this->penerbitModel->getvalidationRules())){
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to(base_url('pustakawan/penerbit/ubah'.$penerbit['kode_penerbit']))->withInput();
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Edit Penerbit Dagal'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit/ubah/'.$penerbit['kode_penerbit']));
        }
    }

    public function delete($kode_penerbit)
    {
        if ($this->penerbitModel->where('kode_penerbit',$kode_penerbit)->delete() == true) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Penerbit Berhasi Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Penerbit Gagal Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }
    }
}
