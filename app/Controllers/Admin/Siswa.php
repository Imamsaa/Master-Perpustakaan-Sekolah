<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\TahunModel;

class Siswa extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;
    protected $tahunModel;
    protected $db;

    function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->tahunModel = new TahunModel();
        $this->db = \Config\Database::connect();
    }

    public function index(): string
    {       
        $builder = $this->db->table('siswa');
        $siswa = $builder->join('kelas','kelas.kode_kelas = siswa.kode_kelas')->get();
        $data = [
            'title' => 'Daftar Siswa',
            'siswa' => $siswa->getResultArray()
        ];
        return view('admin/siswa/tablesiswa', $data);
    }

    public function tambah(): string
    {
        $kelas = $this->kelasModel->findAll();
        $tahun = $this->tahunModel->findAll();
        $data = [
            'title' => 'Tambah Siswa',
            'kelas' => $kelas,
            'tahun' => $tahun
        ];
        return view('admin/siswa/addsiswa', $data);
    }

    public function ubah(): string
    {
        $data = [
            'title' => 'Ubah Siswa'
        ];
        return view('admin/siswa/editsiswa', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
