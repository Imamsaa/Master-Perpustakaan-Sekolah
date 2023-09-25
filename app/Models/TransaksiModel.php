<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nis','kode_buku','status','pinjam','kembali','terlambat','denda'];
    protected $useTimestamps = false;
    protected $validationRules      = [];
}