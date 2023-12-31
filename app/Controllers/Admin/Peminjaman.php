<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\BukuModel;
use App\Models\SiswaModel;

class Peminjaman extends BaseController
{
    protected $transModel;
    protected $bukuModel;
    protected $siswaModel;

    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->transModel = new TransaksiModel();
        $this->bukuModel = new BukuModel();
        $this->siswaModel = new SiswaModel();   
    }

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $pinjam = $this->transModel
        ->join('siswa','siswa.nis = transaksi.nis')
        ->join('buku','buku.kode_buku = transaksi.kode_buku')
        ->where('status','pinjam')->findAll();
        $data = [
            'title' => 'Peminjaman Buku',
            'pinjam' => $pinjam,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/peminjaman/index', $data);
    }

    function save()
    {
        $req = $this->request->getVar();

        if ($this->transModel->where('kode_buku',$req['kode_buku'])->where('status','pinjam')->countAllResults() > 0) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Peminjaman Gagal',
                'message' => 'Status Buku Sedang Dipinjam'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }
        // dd($this->transModel->where('status','pinjam')->where('kode_buku',$req['kode_buku'])->countAllResults());
        if ($this->bukuModel->where('kode_buku',$req['kode_buku'])->countAllResults() <= 0) {
            session()->setFlashdata('kotakok',[
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Buku Tidak Ditemukan'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }elseif ($this->siswaModel->where('nis',$req['nis'])->countAllResults() <= 0) {
            session()->setFlashdata('kotakok',[
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'NIS Siswa Tidak Ditemukan'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }elseif($this->transModel->where('status','pinjam')->where('kode_buku',$req['kode_buku'])->countAllResults() == 1){
            session()->setFlashdata('kotakok',[
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Buku Sedang Dipinjam'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }elseif($this->transModel->where('status','pinjam')->where('kode_buku',$req['kode_buku'])->countAllResults() == 0){
            if ($this->transModel->save([
                'nis' => $req['nis'],
                'kode_buku' => $req['kode_buku'],
                'status' => 'pinjam',
                'pinjam' => date('Y-m-d')
            ]) == true ) 
            {
                session()->setFlashdata('kotaktime',[
                    'status' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Berhasil Melakukan Peminjaman'
                ]);
                return redirect()->to(base_url('pustakawan/peminjaman'));
            }else{
                session()->setFlashdata('pojokatas',[
                    'status' => 'error',
                    'message' => 'Gagal Melakukan Peminjaman'
                ]);
                return redirect()->to(base_url('pustakawan/peminjaman'));
            }
        }
    }

    function delete($kode_buku)
    {
        if ($this->transModel->where('kode_buku',$kode_buku)->delete() == true ) {
            session()->setFlashdata('pojokatas',[
                'status' => 'success',
                'message' => 'Pembatalan Peminjaman Berhasil'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status' => 'error',
                'message' => 'Pembatalan Peminjaman Gagal'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }
    }
}
