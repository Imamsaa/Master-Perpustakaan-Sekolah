<?php

namespace App\Models;

use CodeIgniter\Model;

class WhastappModel extends Model
{
    protected $table      = 'set_whastapp';
    protected $primaryKey = 'id';
    protected $allowedFields = ['endpoint','pengirim','message'];
    protected $useTimestamps = false;
}