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
        $this->transModel = new TransaksiModel();
        $this->bukuModel = new BukuModel();
        $this->siswaModel = new SiswaModel();   
    }

    public function index(): string
    {
        session();
        $pinjam = $this->transModel
        ->join('siswa','siswa.nis = transaksi.nis')
        ->join('buku','buku.kode_buku = transaksi.kode_buku')
        ->where('status','pinjam')->findAll();
        $data = [
            'title' => 'Peminjaman Buku',
            'pinjam' => $pinjam
        ];
        return view('admin/peminjaman/index', $data);
    }

    function save()
    {
        $req = $this->request->getVar();
        // dd($this->transModel->where('status','pinjam')->where('kode_buku',$req['kode_buku'])->countAllResults());
        if ($this->bukuModel->where('kode_buku',$req['kode_buku'])->countAllResults() == 0) {
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Buku Tidak Ditemukan'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }elseif ($this->siswaModel->where('nis',$req['nis'])->countAllResults() == 0) {
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'NIS Siswa Tidak Ditemukan'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }elseif($this->transModel->where('status','pinjam')->where('kode_buku',$req['kode_buku'])->countAllResults() == 1){
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Buku Sedang Dipinjam'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }elseif($this->transModel->where('status','pinjam')->where('kode_buku',$req['kode_buku'])->countAllResults() == 0){
            if ($this->transModel->save([
                'nis' => $req['nis'],
                'kode_buku' => $req['kode_buku'],
                'status' => 'pinjam'
            ]) == true ) 
            {
                session()->setFlashdata('session',[
                    'status' => 'success',
                    'message' => 'Berhasil Melakukan Peminjaman'
                ]);
                return redirect()->to(base_url('pustakawan/peminjaman'));
            }else{
                session()->setFlashdata('session',[
                    'status' => 'error',
                    'message' => 'Gagal Melakukan Peminjaman'
                ]);
                return redirect()->to(base_url('pustakawan/peminjaman'));
            }
        }
    }

    function delete($id)
    {
        if ($this->transModel->where('id',$id)->delete() == true ) {
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Pembatalan Peminjaman Berhasil'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }else{
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Pembatalan Peminjaman Gagal'
            ]);
            return redirect()->to(base_url('pustakawan/peminjaman'));
        }
    }
}
