<?php

namespace App\Models;

use CodeIgniter\Model;

class SelectorModel extends Model
{
    protected $table      = 'selector';
    protected $primaryKey = 'id';
    protected $allowedFields = ['selector'];
    protected $useTimestamps = false;
}