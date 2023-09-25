<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TahunModel;

class Tahun extends BaseController
{
    protected $tahunModel;

    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->tahunModel = new TahunModel();
    }

    public function index(): string
    {   
        session();
        $dataTahun = $this->tahunModel->findAll();
        $data = [
            'title' => 'Daftar Tahun Ajaran',
            'tahun' => $dataTahun
        ];
        return view('admin/tahun/tabletahun', $data);
    }

    public function tambah(): string
    {
        session();
        $data = [
            'title' => 'Tambah Tahun Ajaran'
        ];
        return view('admin/tahun/addtahun', $data);
    }

    function save()
    {
        if (!$this->validate($this->tahunModel->getvalidationRules())) {
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('pustakawan/tahun/tambah'))->withInput();
        }elseif($this->tahunModel->save($this->request->getVar()) == true){
            session()->setFlashdata('session',[
                'status'    => 'success', 
                'message'   => 'Tahun Berhasil Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/tahun'));
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error', 
                'message'   => 'Tahun Gagal Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/tahun'))->withInput();
        }
    }

    public function ubah($kode_tahun): string
    {
        session();
        $tahun = $this->tahunModel->where('kode_tahun',$kode_tahun)->first();
        $data = [
            'title' => 'Ubah Tahun Ajaran',
            'tahun' => $tahun
        ];
        return view('admin/tahun/edittahun', $data);
    }

    function update()
    {
        $tahun = $this->request->getVar();
        if(
            $this->tahunModel->where('kode_tahun',$tahun['kode_tahun'])->set([
                'nama_tahun'    => $tahun['nama_tahun'],
                'aktif'         => $tahun['aktif'],
                'kadaluarsa'    => $tahun['kadaluarsa']
            ])->update() == true
        ){
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Tahun Berhasil Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/tahun'));
        }elseif ($this->validate($this->tahunModel->getvalidationRules())) {
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('pustakawan/tahun/ubah'.$tahun['kode_tahun']))->withInput();
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Tahun Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/tahun/ubah/'.$tahun['kode_tahun']))->withInput();
        }
    }

    public function delete($kode_tahun)
    {
        if ($this->tahunModel->where('kode_tahun', $kode_tahun)->delete() == true) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Tahun Berhasil Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/tahun'));
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Tahun Gagal Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/tahun'));
        }
    }
}
