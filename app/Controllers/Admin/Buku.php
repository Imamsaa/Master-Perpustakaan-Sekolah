<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;
    protected $db;

    function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->db = \Config\Database::connect();
    }

    public function index(): string
    {
        // QUERY SELECT
        $builder = $this->db->table('buku');
        $builder->select('*,COUNT(judul_buku) stok')
        ->join('penerbit','buku.kode_penerbit = penerbit.kode_penerbit')
        ->join('rak','buku.kode_rak = rak.kode_rak')
        ->join('jenis_buku', 'buku.kode_jenis = jenis_buku.kode_jenis')
        ->groupBy('judul_buku');
        $buku = $builder->get()->getResultArray();

        $data = [
            'title' => 'Daftar Buku',
            'buku'  => $buku
        ];
        return view('admin/buku/tablebuku', $data);
    }

    public function tambah(): string
    {
        $data = [
            'title' => 'Tambah Buku'
        ];
        return view('admin/buku/addbuku', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Buku'
        ];
        return view('admin/buku/editbuku', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
