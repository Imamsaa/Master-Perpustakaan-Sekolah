<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TahunModel;
use App\Models\SiswaModel;

class Tahun extends BaseController
{
    protected $tahunModel;
    protected $siswaModel;

    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->tahunModel = new TahunModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {   
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $dataTahun = $this->tahunModel->findAll();
        $data = [
            'title' => 'Daftar Tahun Ajaran',
            'tahun' => $dataTahun,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/tahun/tabletahun', $data);
    }

    public function tambah()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Tambah Tahun Ajaran',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/tahun/addtahun', $data);
    }

    function save()
    {
        $req = $this->request->getVar();
        if ($this->tahunModel->where('kode_tahun',$req['kode_tahun'])->countAllResults() > 0 )
        {
            session()->setFlashdata('kotakok',[
                'status'    => 'warning',
                'title' => 'Gagal',
                'message'   => 'Kode Tahun Telah Digunakan'
            ]);
            return redirect()->to(base_url('pustakawan/tahun/tambah'))->withInput();
        }
        
        if($this->tahunModel->save($this->request->getVar()) == true){
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Tahun Berhasil Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/tahun'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status'    => 'error', 
                'message'   => 'Tahun Gagal Ditambahkan'
            ]);
            return redirect()->to(base_url('pustakawan/tahun/tambah'))->withInput();
        }
    }

    public function ubah($kode_tahun)
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $tahun = $this->tahunModel->where('kode_tahun',$kode_tahun)->first();
        $data = [
            'title' => 'Ubah Tahun Ajaran',
            'tahun' => $tahun,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/tahun/edittahun', $data);
    }

    function update()
    {
        $tahun = $this->request->getVar();
        if($this->tahunModel->where('kode_tahun',$tahun['kode_tahun'])->set([
                'nama_tahun'    => $tahun['nama_tahun'],
                'aktif'         => $tahun['aktif'],
                'kadaluarsa'    => $tahun['kadaluarsa']
            ])->update() == true
        ){
            session()->setFlashdata('pojokatas',[
                'status'    => 'success',
                'message'   => 'Tahun Berhasil Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/tahun'));
        }else{
            session()->setFlashdata('kotakok',[
                'status'    => 'error',
                'title' => 'Gagal',
                'message'   => 'Tahun Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/tahun/ubah/'.$tahun['kode_tahun']))->withInput();
        }
    }

    public function delete($kode_tahun)
    {
        $this->tahunModel->disableForeignKeyChecks();
        if ($this->siswaModel->where('kode_tahun',$kode_tahun)->countAllResults() <= 0) {
            if ($this->tahunModel->where('kode_tahun', $kode_tahun)->delete() == true) {
                session()->setFlashdata('pojokatas',[
                    'status'    => 'success',
                    'message'   => 'Tahun Berhasil Dihapus'
                ]);
                return redirect()->to(base_url('pustakawan/tahun'));
            }else{
                session()->setFlashdata('pojokatas',[
                    'status'    => 'error',
                    'message'   => 'Tahun Gagal Dihapus'
                ]);
                return redirect()->to(base_url('pustakawan/tahun'));
            }   
        }else{
            session()->setFlashdata('kotakok',[
                'status'    => 'warning',
                'title' => 'Gagal Menghapus',
                'message'   => 'Tahun Masih Digunakan'
            ]);
            return redirect()->to(base_url('pustakawan/tahun'));
        }
    }
}
