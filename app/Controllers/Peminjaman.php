<?php

namespace App\Controllers;
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

    public function index(): string
    {
        $data = [
            'title' => 'Peminjaman',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus
        ];
        return view('pages/peminjaman',$data);
    }

    function siswa()
    {
        $req = $this->request->getVar();
        $waktu = $this->siswaModel->join('tahun_ajaran', 'tahun_ajaran.kode_tahun = siswa.kode_tahun')->where('nis',$req['nis'])->first();
        // dd($this->transModel->where('status','pinjam')->where('kode_buku',$req['kode_buku'])->countAllResults());
        if ($this->bukuModel->where('kode_buku',$req['kode_buku'])->countAllResults() == 0) {
            session()->setFlashdata('kotaktime',[
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Buku Tidak Ditemukan'
            ]);
            return redirect()->to(base_url('peminjaman'));
        }elseif ($this->siswaModel->where('nis',$req['nis'])->countAllResults() == 0) {
            session()->setFlashdata('kotaktime',[
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'NIS Siswa Tidak Ditemukan'
            ]);
            return redirect()->to(base_url('peminjaman'));
        }elseif ($waktu['kadaluarsa'] <= date('Y-m-d')) {
            session()->setFlashdata('kotaktime',[
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Masa Berlaku Sudah Habis'
            ]);
            return redirect()->to(base_url('peminjaman'));
        }elseif($this->transModel->where('status','pinjam')->where('kode_buku',$req['kode_buku'])->countAllResults() == 1){
            session()->setFlashdata('kotaktime',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Buku Sedang Dipinjam'
            ]);
            return redirect()->to(base_url('peminjaman'));
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
                return redirect()->to(base_url('peminjaman'));
            }else{
                session()->setFlashdata('kotaktime',[
                    'status' => 'error',
                    'title' => 'Gagal',
                    'message' => 'Gagal Melakukan Peminjaman'
                ]);
                return redirect()->to(base_url('peminjaman'));
            }
        }
    }
}
