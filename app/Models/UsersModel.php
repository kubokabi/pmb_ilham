<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_users';
    protected $allowedFields = ['nama', 'email', 'password', 'role', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
}