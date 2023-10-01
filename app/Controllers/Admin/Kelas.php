<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\SiswaModel;

class Kelas extends BaseController
{
    protected $kelasModel;
    protected $siswaModel;

    function __construct()
    {
        $this->kelasModel = new KelasModel();   
        $this->siswaModel = new SiswaModel();
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
            'title' => 'Tambah Kelas',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/kelas/addkelas', $data);
    }

    function save()
    {
        $req = $this->request->getVar();
        if ($this->kelasModel->where('kode_kelas',$req['kode_kelas'])->countAllResults() > 0) {
            session()->setFlashdata('kotakok',[
                'status'    => 'warning',
                'title'     => 'Gagal',
                'message'   => 'Kode Kelas Telah Digunakan'
            ]);
            return redirect()->to(base_url('pustakawan/kelas/tambah'))->withInput();
        }
        if($this->kelasModel->save($req) == true){
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Kelas Berhasil Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/kelas'));
        }else{
            session()->setFlashdata('pojokatas',[
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
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Kelas Berhasil Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/kelas'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Kelas Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/kelas/ubah/'.$kelas['kode_kelas']))->withInput();
        }
    }

    public function delete($kode_kelas)
    {
        $this->kelasModel->disableForeignKeyChecks();
        if ($this->siswaModel->where('kode_kelas',$kode_kelas)->countAllResults() > 0) {
            session()->setFlashdata('kotakok',[
                'status'    => 'warning',
                'title' => 'Gagal',
                'message'   => 'Kelas Masih Digunakan'
            ]);
            return redirect()->to(base_url('pustakawan/kelas'));
        }
        if ($this->kelasModel->where('kode_kelas',$kode_kelas)->delete() == true ) {
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Data Kelas Berhasil Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/kelas'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Data Kelas Gagal Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/kelas'));
        }
    }

}
