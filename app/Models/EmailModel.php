<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
    protected $table      = 'set_email';
    protected $primaryKey = 'id';
    protected $allowedFields = ['smtp','email','password_email','port','nama','subject','message'];
    protected $useTimestamps = false;
}