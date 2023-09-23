<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiswaModel;

class Siswa extends BaseController
{
    protected $siswaModel;
    protected $db;

    function __construct()
    {
        $this->siswaModel = new SiswaModel();
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
        $data = [
            'title' => 'Tambah Siswa'
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
