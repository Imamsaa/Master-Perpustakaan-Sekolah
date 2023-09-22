<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerbitModel extends Model
{
    protected $table      = 'penerbit';
    // protected $primaryKey = 'kode_tahun';
    protected $allowedFields = ['kode_penerbit','nama_penerbit'];
    protected $useTimestamps = false;
    protected $validationRules      = [
        'kode_penerbit' => [
            'rules' => 'is_unique[penerbit.kode_penerbit]',
            'errors' => [
                'is_unique' => 'Kode Penerbit Telah Digunakan'
            ],
        ],
    ];
}