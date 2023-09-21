<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table      = 'kelas';
    // protected $primaryKey = 'kode_tahun';
    protected $allowedFields = ['kode_kelas','nama_kelas'];
    protected $useTimestamps = false;
    protected $validationRules      = [
        'kode_kelas' => [
            'rules' => 'is_unique[kelas.kode_kelas]',
            'errors' => [
                'is_unique' => 'Kode Kelas Telah Digunakan'
            ],
        ],
    ];
}