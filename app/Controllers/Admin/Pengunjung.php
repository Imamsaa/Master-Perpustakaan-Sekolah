<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\KelasModel;
use App\Models\PengunjungModel;

class Pengunjung extends BaseController
{
    protected $trans;
    protected $kelasModel;
    protected $pen;

    public function __construct() {
        $this->trans = new TransaksiModel();
        $this->kelasModel = new KelasModel();
        $this->pen = new PengunjungModel();
    }

    public function index() 
    {
        session();
        
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        if ($this->request->getPost()) {
            $req = $this->request->getPost();
        //     // dd($req);
            $where = [];

        //     if ($req['status'] == 'pinjam') {
        //         if ($req['awal'] != '') {
        //             // $where = "pinjam >= '".$req['awal']."' AND kembali <= '".$req['akhir']."'";
        //             $where['pinjam >='] = $req['awal'];
        //         }
        //     }else{
        //         if ($req['awal'] != '' AND $req['akhir'] != '') {
        //             // $where = "pinjam >= '".$req['awal']."' AND kembali <= '".$req['akhir']."'";
        //             $where['pinjam >='] = $req['awal'];
        //             $where['kembali <='] =  $req['akhir'];
        //         }
        //     }
        if ($req['awal'] != '' AND $req['akhir'] != '') {
            // $where = "pinjam >= '".$req['awal']."' AND kembali <= '".$req['akhir']."'";
            $where['waktu >='] = $req['awal'];
            $where['waktu <='] =  $req['akhir'];
        }elseif ($req['awal'] != '' AND $req['akhir'] == '') {
            $where['waktu >='] = $req['awal'];
        }elseif ($req['awal'] == '' AND $req['akhir'] != '') {
            $where['waktu <='] =  $req['akhir'];
        }



        if ($req['nis'] != '') {
            $where['pengunjung.nis ='] = $req['nis'];
        }

        if ($req['kelas'] != '') {
            $where['siswa.kode_kelas ='] = $req['kelas'];
        }

        //     $where['status ='] = $req['status'];

        if (empty($where)) {
            redirect()->to(base_url('pustakawan/pengunjung'));
        }

            if ($req['nama'] != '') {
                $lap = $this->pen
                ->where($where)
                // ->where($where)
                ->like('siswa.nama_siswa',$req['nama'])
                ->join('siswa', 'siswa.nis = pengunjung.nis')
                ->join('kelas', 'kelas.kode_kelas = siswa.kode_kelas')
                ->findAll();
                // $lap = $this->trans
                // ->where($where)
                // ->like('siswa.nama_siswa',$req['nama'])
                // ->join('siswa', 'siswa.nis = transaksi.nis')
                // ->join('kelas','siswa.kode_kelas = kelas.kode_kelas')
                // ->join('buku','buku.kode_buku = transaksi.kode_buku')
                // ->join('tahun_ajaran', 'siswa.kode_tahun = tahun_ajaran.kode_tahun')
                // ->join('penerbit', 'buku.kode_penerbit = penerbit.kode_penerbit')
                // ->join('rak', 'rak.kode_rak = buku.kode_rak')
                // ->join('jenis_buku','jenis_buku.kode_jenis = buku.kode_jenis')
                // ->findAll();
            }else{
                // dd($where);
                $lap = $this->pen
                ->where($where)
                ->join('siswa', 'siswa.nis = pengunjung.nis')
                ->join('kelas', 'kelas.kode_kelas = siswa.kode_kelas')
                ->findAll();
                // $lap = $this->trans
                // ->where($where)
                // ->join('siswa', 'siswa.nis = transaksi.nis')
                // ->join('kelas','siswa.kode_kelas = kelas.kode_kelas')
                // ->join('buku','buku.kode_buku = transaksi.kode_buku')
                // ->join('tahun_ajaran', 'siswa.kode_tahun = tahun_ajaran.kode_tahun')
                // ->join('penerbit', 'buku.kode_penerbit = penerbit.kode_penerbit')
                // ->join('rak', 'rak.kode_rak = buku.kode_rak')
                // ->join('jenis_buku','jenis_buku.kode_jenis = buku.kode_jenis')
                // ->findAll();
            }
        }else{
            $lap = $this->pen
            ->join('siswa', 'siswa.nis = pengunjung.nis')
            ->join('kelas', 'kelas.kode_kelas = siswa.kode_kelas')
            ->findAll();
        }


        // $set = $this->trans->first();
        // $hasillab = [];
        // $now  = date_create();
        // foreach ($lap as $l) {
        //     if ($l['status'] == 'kembali') {
        //         $hasillab[] = $l;
        //     }else{
        //         $ambil = date_diff(date_create($l['pinjam']),$now);
        //         $terlambat = $ambil->days - $set['terlambat'];
        //         if ($terlambat < 1) {
        //             $hasil = 0;
        //         }elseif($set['terlambat'] == 0){
        //             $hasil = 0;
        //         }else{
        //             $hasil = $terlambat;
        //         }
        //         $l['terlambat'] = $terlambat;
        //         $l['denda'] = $hasil;
        //         $hasillab[] = $l;
        //     }
        // }

        // $lap = $this->pen
        // ->join('siswa', 'siswa.nis = pengunjung.nis')
        // ->join('kelas', 'kelas.kode_kelas = siswa.kode_kelas')
        // ->findAll();

        $kelas = $this->kelasModel->findAll();

        $data = [
            'title' => 'Laporan Pengunjung',
            'lap' => $lap,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku,
            'kelas' => $kelas
        ];
        return view('admin/pengunjung/index', $data);
    }
}
