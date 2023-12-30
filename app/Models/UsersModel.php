<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{

    protected $table = "users";
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_name','user_email','user_password','user_created_at', 'user_role'];
}