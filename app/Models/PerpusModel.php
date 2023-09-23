<?php

namespace App\Models;

use CodeIgniter\Model;

class PerpusModel extends Model
{
    protected $table      = 'perpus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_perpus','slogan_perpus','peraturan_perpus'];
    protected $useTimestamps = false;
}