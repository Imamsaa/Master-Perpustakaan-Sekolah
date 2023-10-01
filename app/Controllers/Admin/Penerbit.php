<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenerbitModel;
use App\Models\BukuModel;

class Penerbit extends BaseController
{
    protected $penerbitModel;
    protected $bukuModel;

    function __construct()
    {
        $this->penerbitModel = new PenerbitModel;  
        $this->bukuModel = new BukuModel;  
    }

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $penerbit = $this->penerbitModel->findAll();

        $data = [
            'title' => 'Daftar Penerbit',
            'penerbit' => $penerbit,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/penerbit/tablepenerbit', $data);
    }

    public function tambah()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Tambah Penerbit',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/penerbit/addpenerbit', $data);
    }

    function save()
    {
        $req = $this->request->getVar();
        if ($this->penerbitModel->where('kode_penerbit',$req['kode_penerbit'])->countAllResults() > 0) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Kode Penerbit Sudah Digunakan'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit/tambah'))->withInput();
        }
        if ($this->penerbitModel->save($req) == true) {
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Penerbit Berhasil Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Penerbit Gagal Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }
    }

    public function ubah($kode_penerbit)
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $penerbit = $this->penerbitModel->where('kode_penerbit',$kode_penerbit)->first();
        $data = [
            'title' => 'Ubah Penerbit',
            'penerbit' => $penerbit,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
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
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Edit Penerbit Berhasil'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Edit Penerbit Dagal'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit/ubah/'.$penerbit['kode_penerbit']));
        }
    }

    public function delete($kode_penerbit)
    {
        $this->bukuModel->disableForeignKeyChecks();
        if ($this->bukuModel->where('kode_penerbit',$kode_penerbit)->countAllResults() > 0) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Penerbit Masih Digunakan'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }
        if ($this->penerbitModel->where('kode_penerbit',$kode_penerbit)->delete() == true) {
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Penerbit Berhasi Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Penerbit Gagal Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/penerbit'));
        }
    }
}
