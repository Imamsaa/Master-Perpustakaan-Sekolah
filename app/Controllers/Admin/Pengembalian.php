<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettransaksiModel;
use App\Models\TransaksiModel;

class Pengembalian extends BaseController
{
    protected $setTrans;
    protected $trans;

    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->trans = new TransaksiModel();
        $this->setTrans = new SettransaksiModel();   
    }

    public function index($id = null): string
    {
        session();
        $set = $this->setTrans->first();
        $pinjam = $this->trans->where('status','pinjam')->findAll();
        $kembali = [];
        $now  = date_create();
        foreach ($pinjam as $p) {
            $ambil = date_diff(date_create($p['pinjam']),$now);

            $terlambat = $ambil->days - $set['terlambat'];
            if ($terlambat < 1) {
                $hasil = 0;
            }elseif($set['terlambat'] == 0){
                $hasil = 0;
            }else{
                $hasil = $terlambat;
            }

            $kembali[] = [
                'id' => $p['id'],
                'nis' => $p['nis'],
                'kode_buku' => $p['kode_buku'],
                'pinjam' => $p['pinjam'],
                'terlambat' => $hasil." HARI"
            ];
        }

        $peminjam = $this->trans
        ->join('siswa', 'siswa.nis = transaksi.nis')
        ->join('buku', 'buku.kode_buku = transaksi.kode_buku')
        ->where('id',$id)
        ->first();
        if ($id == null) {
            $data = [
                'title' => 'Peminjaman Buku',
                'kembali' => $kembali
            ];
        }else{
            $pinjam = $this->trans->where('id',$id)->first();
            $ambil = date_diff(date_create($pinjam['pinjam']),$now);
            $terlambat = $ambil->days - $set['terlambat'];
            if ($terlambat < 1) {
                $hasil = 0;
            }elseif($set['terlambat'] == 0){
                $hasil = 0;
            }else{
                $hasil = $terlambat;
            }


            $denda = $hasil*$set['denda'];
            $data = [
                'title' => 'Peminjaman Buku',
                'kembali' => $kembali,
                'peminjam' => $peminjam,
                'terlambat' => $hasil,
                'denda' => $denda
            ];
        }
        return view('admin/pengembalian/index', $data);
    }

    function update()
    {
        $kembali = $this->request->getVar();  
        if($this->trans->where('id',$kembali['id'])->set([
            'kembali' => date('Y-m-d'),
            'status' => 'kembali',
            'terlambat' => $kembali['terlambat'],
            'denda'=> $kembali['denda']
        ])->update() == true )
        {
            session()->setFlashdata('session',[
                'status'    => 'success',
                'message'   => 'Pengembalian Berhasil'
            ]);
            return redirect()->to(base_url('pustakawan/pengembalian'));
        }else{
            session()->setFlashdata('session',[
                'status'    => 'error',
                'message'   => 'Pengembalian Gagal'
            ]);
            return redirect()->to(base_url('pustakawan/pengembalian'));
        }
    }
}
