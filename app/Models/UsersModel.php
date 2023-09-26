<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user','nomor_wa','password','email_user','id_level','alamat_user','foto_user'];
    protected $useTimestamps = false;
}