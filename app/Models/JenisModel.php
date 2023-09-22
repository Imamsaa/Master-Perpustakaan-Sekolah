<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $table      = 'jenis_buku';
    // protected $primaryKey = 'kode_tahun';
    protected $allowedFields = ['kode_jenis','nama_jenis','kode_warna'];
    protected $useTimestamps = false;
    protected $validationRules      = [
        'kode_jenis' => [
            'rules' => 'is_unique[jenis_buku.kode_jenis]',
            'errors' => [
                'is_unique' => 'Kode Telah Digunakan'
            ],
        ],
    ];
}