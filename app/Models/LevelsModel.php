<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelsModel extends Model
{
    protected $table      = 'levels';
    protected $primaryKey = 'id_level';
    protected $allowedFields = ['level','nama_level'];
    protected $useTimestamps = false;
}