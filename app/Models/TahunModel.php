<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunModel extends Model
{
    protected $table      = 'tahun_ajaran';
    // protected $primaryKey = 'kode_tahun';
    protected $allowedFields = ['kode_tahun','nama_tahun','aktif','kadaluarsa'];
    protected $useTimestamps = false;
    protected $validationRules      = [
        'kode_tahun' => [
            'rules' => 'is_unique[tahun_ajaran.kode_tahun]',
            'errors' => [
                'is_unique' => 'Kode Tahun Telah Digunakan'
            ],
        ],
    ];
}