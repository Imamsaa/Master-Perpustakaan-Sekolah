<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JenisModel;
use App\Models\BukuModel;

class Jenis extends BaseController
{
    protected $jenisModel;
    protected $bukuModel;

    function __construct()
    {
        $this->jenisModel = new JenisModel();
        $this->bukuModel = new BukuModel();    
    }

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $jenis = $this->jenisModel->findAll();
        $data = [
            'title' => 'Daftar Janis Buku',
            'jenis' => $jenis,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/jenis/tablejenis', $data);
    }

    public function tambah()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Tambah Jenis Buku',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/jenis/addjenis', $data);
    }

    function save()
    {
        $req = $this->request->getVar();
        if ($this->bukuModel->where('kode_jenis',$req['kode_jenis'])->countAllResults() > 0) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Kode Jenis Buku Sudah Digunakan'
            ]);
            return redirect()->to(base_url('pustakawan/jenis/tambah'))->withInput();
        }

        if ($this->jenisModel->save($req) == true) {
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Data Jenis Buku Berhasil Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/jenis'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Data Jenis Buku Gagal Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/jenis/tambah'))->withInput();
        }
    }

    public function ubah($kode_jenis)
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $jenis = $this->jenisModel->where('kode_jenis',$kode_jenis)->first();
        $data = [
            'title' => 'Ubah Jenis Buku',
            'jenis' => $jenis,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
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
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Data Jenis buku berhasil diubah'
            ]);
            return redirect()->to(base_url('pustakawan/jenis'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Data Jenis buku gagal diubah'
            ]);
            return redirect()->to(base_url('pustakawan/jenis/ubah/'.$jenis['kode_jenis']))->withInput();
        }
    }

    public function delete($kode_jenis)
    {
        $this->jenisModel->disableForeignKeyChecks();

        if ($this->bukuModel->where('kode_jenis',$kode_jenis)->countAllResults() > 0) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Data Jenis Buku Masih Digunakan'
            ]);
            return redirect()->to(base_url('pustakawan/jenis'));
        }

        if ($this->jenisModel->where('kode_jenis',$kode_jenis)->delete() == true) {
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Data Jenis Buku Berhasil Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/jenis'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error',
                'message'   => 'Data Jenis Buku Gagal Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/jenis'));
        }
    }
}
