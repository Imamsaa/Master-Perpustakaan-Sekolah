<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'siswa';
    // protected $primaryKey = 'nisn';
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
        'foto' => [
            'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'max_size' => 'Foto maksimal 1MB',
                'is_image' => 'File yang anda masukan bukan gambar',
                'mime_in'  => 'File yang anda masukan bukan gambar'
            ],
        ],
    ];
}