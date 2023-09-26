<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;

class Laporan extends BaseController
{
    protected $trans;

    public function __construct() {
        $this->trans = new TransaksiModel();
    }

    public function index(): string
    {
        session();
        $lap = $this->trans
        ->join('siswa', 'siswa.nis = transaksi.nis')
        ->join('kelas','siswa.kode_kelas = kelas.kode_kelas')
        ->join('buku','buku.kode_buku = transaksi.kode_buku')
        ->join('tahun_ajaran', 'siswa.kode_tahun = tahun_ajaran.kode_tahun')
        ->join('penerbit', 'buku.kode_penerbit = penerbit.kode_penerbit')
        ->join('rak', 'rak.kode_rak = buku.kode_rak')
        ->join('jenis_buku','jenis_buku.kode_jenis = buku.kode_jenis')
        ->findAll();
        $data = [
            'title' => 'Laporan Transaksi',
            'lap' => $lap
        ];
        return view('admin/laporan/tablelaporan', $data);
    }

    function reset()
    {
        if ($this->trans->where('status','kembali')->delete() == true) {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Laporan berhasil di reset'
            ]);
            return redirect()->to(base_url('pustakawan/laporan'));
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Laporan gagal di reset'
            ]);
            return redirect()->to(base_url('pustakawan/laporan'));
        }
    }
}
