<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'siswa';
    protected $allowedFields = ['nis','nisn','barcode_siswa','nama_siswa','kode_kelas','kode_tahun','wa','email','alamat_siswa','foto'];
    protected $useTimestamps = false;
    protected $validationRules      = [];
}