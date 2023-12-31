<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\KelasModel;

class Laporan extends BaseController
{
    protected $trans;
    protected $kelasModel;

    public function __construct() {
        $this->trans = new TransaksiModel();
        $this->kelasModel = new KelasModel();
    }

    public function index() 
    {
        session();
        
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        if ($this->request->getPost()) {
            $req = $this->request->getPost();
            // dd($req);
            $where = [];

            if ($req['status'] != '') {
                $where['status'] = $req['status'];
            }

            if ($req['awal'] != '' AND $req['akhir'] != '') {
                // $where = "pinjam >= '".$req['awal']."' AND kembali <= '".$req['akhir']."'";
                $where['pinjam >='] = $req['awal'];
                $where['pinjam <='] =  $req['akhir'];
            }elseif ($req['awal'] != '' AND $req['akhir'] == '') {
                $where['pinjam >='] = $req['awal'];
            }elseif ($req['awal'] == '' AND $req['akhir'] != '') {
                $where['pinjam <='] =  $req['akhir'];
            }

            if ($req['nis'] != '') {
                $where['transaksi.nis ='] = $req['nis'];
            }

            if ($req['kelas'] != '') {
                $where['siswa.kode_kelas ='] = $req['kelas'];
            }

            // $where['status ='] = $req['status'];

            if (empty($where)) {
                redirect()->to(base_url('pustakawan/laporan'));
            }

            if ($req['nama'] != '') {
                $lap = $this->trans
                ->where($where)
                ->like('siswa.nama_siswa',$req['nama'])
                ->join('siswa', 'siswa.nis = transaksi.nis')
                ->join('kelas','siswa.kode_kelas = kelas.kode_kelas')
                ->join('buku','buku.kode_buku = transaksi.kode_buku')
                ->join('tahun_ajaran', 'siswa.kode_tahun = tahun_ajaran.kode_tahun')
                ->join('penerbit', 'buku.kode_penerbit = penerbit.kode_penerbit')
                ->join('rak', 'rak.kode_rak = buku.kode_rak')
                ->join('jenis_buku','jenis_buku.kode_jenis = buku.kode_jenis')
                ->findAll();
            }else{
                // dd($where);
                $lap = $this->trans
                ->where($where)
                ->join('siswa', 'siswa.nis = transaksi.nis')
                ->join('kelas','siswa.kode_kelas = kelas.kode_kelas')
                ->join('buku','buku.kode_buku = transaksi.kode_buku')
                ->join('tahun_ajaran', 'siswa.kode_tahun = tahun_ajaran.kode_tahun')
                ->join('penerbit', 'buku.kode_penerbit = penerbit.kode_penerbit')
                ->join('rak', 'rak.kode_rak = buku.kode_rak')
                ->join('jenis_buku','jenis_buku.kode_jenis = buku.kode_jenis')
                ->findAll();
            }
        }else{
            $lap = $this->trans
            ->join('siswa', 'siswa.nis = transaksi.nis')
            ->join('kelas','siswa.kode_kelas = kelas.kode_kelas')
            ->join('buku','buku.kode_buku = transaksi.kode_buku')
            ->join('tahun_ajaran', 'siswa.kode_tahun = tahun_ajaran.kode_tahun')
            ->join('penerbit', 'buku.kode_penerbit = penerbit.kode_penerbit')
            ->join('rak', 'rak.kode_rak = buku.kode_rak')
            ->join('jenis_buku','jenis_buku.kode_jenis = buku.kode_jenis')
            ->findAll();
        }


        $set = $this->trans->first();
        $hasillab = [];
        $now  = date_create();
        foreach ($lap as $l) {
            if ($l['status'] == 'kembali') {
                $hasillab[] = $l;
            }else{
                $ambil = date_diff(date_create($l['pinjam']),$now);
                $terlambat = $ambil->days - $set['terlambat'];
                if ($terlambat < 1) {
                    $hasil = 0;
                }elseif($set['terlambat'] == 0){
                    $hasil = 0;
                }else{
                    $hasil = $terlambat;
                }
                $l['terlambat'] = $terlambat;
                $l['denda'] = $hasil;
                $hasillab[] = $l;
            }
        }

        $kelas = $this->kelasModel->findAll();
        $data = [
            'title' => 'Laporan Transaksi',
            'lap' => $hasillab,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku,
            'kelas' => $kelas
        ];
        return view('admin/laporan/tablelaporan', $data);
    }
}
