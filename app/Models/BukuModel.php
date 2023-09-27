<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $allowedFields = ['kode_buku','barcode_buku','judul_buku','slug','isbn','tahun_buku','kode_penerbit','kode_rak','kode_jenis','halaman','deskripsi_buku','sampul'];
    protected $useTimestamps = false;
    protected $validationRules      = [];
}