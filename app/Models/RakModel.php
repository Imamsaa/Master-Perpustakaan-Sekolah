<?php

namespace App\Models;

use CodeIgniter\Model;

class RakModel extends Model
{
    protected $table      = 'rak';
    // protected $primaryKey = 'kode_tahun';
    protected $allowedFields = ['kode_rak','nama_rak'];
    protected $useTimestamps = false;
    protected $validationRules      = [
        'kode_rak' => [
            'rules' => 'is_unique[rak.kode_rak]',
            'errors' => [
                'is_unique' => 'Kode Rak Buku Telah Digunakan'
            ],
        ],
    ];
}