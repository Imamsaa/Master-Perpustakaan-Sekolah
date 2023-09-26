<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KelasModel;

class Kelas extends BaseController
{
    protected $kelasModel;

    function __construct()
    {
        $this->kelasModel = new KelasModel();   
    }

    public function index()
    {
        session();
        
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $dataKelas = $this->kelasModel->findAll();
        $data = [
            'title' => 'Daftar Kelas',
            'kelas' => $dataKelas,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/kelas/tablekelas', $data);
    }

    public function tambah()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Tambah Kelas'
        ];
        return view('admin/kelas/addkelas', $data);
    }

    function save()
    {
        if($this->kelasModel->save($this->request->getVar()) == true){
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Kelas Berhasil Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/kelas'));
        }elseif (!$this->validate($this->kelasModel->getvalidationRules())) {
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to(base_url('pustakawan/kelas/tambah'))->withInput();
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Kelas Gagal Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/kelas/tambah'))->withInput();
        }
    }

    public function ubah($kode_kelas)
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $kelas = $this->kelasModel->where('kode_kelas',$kode_kelas)->first();
        $data = [
            'title' => 'Ubah Kelas',
            'kelas' => $kelas,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/kelas/editkelas', $data);
    }

    function update()
    {
        $kelas = $this->request->getVar();
        if($this->kelasModel->where('kode_kelas',$kelas['kode_kelas'])->set([
            'nama_kelas'    => $kelas['nama_kelas']
        ])->update() == true
        ){
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Kelas Berhasil Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/kelas'));
        }elseif (!$this->validate($this->kelasModel->getvalidationRules())) {
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('pustakawan/kelas/ubah/'.$kelas['kode_kelas']))->withInput();
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Kelas Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/kelas/ubah/'.$kelas['kode_kelas']))->withInput();
        }
    }

    public function hapus()
    {
        // isi kode disini
    }
}
