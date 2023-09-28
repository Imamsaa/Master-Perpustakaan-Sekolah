<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\SettransaksiModel;

class Pesan extends BaseController
{
    protected $trans;
    protected $setTrans;

    function __construct()
    {
        $this->trans = new TransaksiModel();
        $this->setTrans = new SettransaksiModel();    
    }

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $kirim = [];
        $set = $this->setTrans->first();
        // $pinjam = $this->trans->where('status','pinjam')->findAll();
        $now  = date_create();
        $proses = $this->trans
        ->join('siswa','siswa.nis = transaksi.nis')
        ->join('buku','buku.kode_buku = transaksi.kode_buku')
        ->join('kelas','kelas.kode_kelas = siswa.kode_kelas')
        ->where('status','pinjam')
        ->findAll();

        foreach ($proses as $p) {

            $ambil = date_diff(date_create($p['pinjam']),$now);

            $terlambat = $ambil->days - $set['terlambat'];

            if ($terlambat < 1) {
                $hasil = 0;
            }elseif($set['terlambat'] == 0){
                $hasil = 0;
            }else{
                $hasil = $terlambat;
            }

            $kirim[] = [
                'nis' => $p['nis'],
                'nama_siswa' => $p['nama_siswa'],
                'kode_buku' => $p['kode_buku'],
                'judul_buku' => $p['judul_buku'],
                'terlambat' => $hasil,
                'denda' => $hasil*$set['denda']
            ];
        }

        $data = [
            'title' => 'Kirim Pesan',
            'pesan' => $kirim,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/pesan/index',$data);
    }

    function whastapp($nis)
    {
        
    }

    function email($nis)
    {
        
    }
}
