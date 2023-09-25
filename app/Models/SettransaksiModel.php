<?php

namespace App\Models;

use CodeIgniter\Model;

class SettransaksiModel extends Model
{
    protected $table      = 'set_transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['terlambat','denda'];
    protected $useTimestamps = false;
}