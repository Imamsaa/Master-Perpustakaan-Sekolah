<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'siswa';
    protected $allowedFields = ['nis','nisn','nama_siswa','kode_kelas','kode_tahun','wa','email','alamat_siswa','foto'];
    protected $useTimestamps = false;
    protected $validationRules      = [
        'nis' => [
            'rules' => 'is_unique[siswa.nis]',
            'errors' => [
                'is_unique' => 'Nis Telah Terdaftar'
            ],
        ],
        'nisn' => [
            'rules' => 'is_unique[siswa.nisn]',
            'errors' => [
                'is_unique' => 'NISN Telah Terdaftar'
            ],
        ],
    ];
}