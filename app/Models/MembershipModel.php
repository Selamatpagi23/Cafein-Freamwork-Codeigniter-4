<?php

namespace App\Models;

use CodeIgniter\Model;

class MembershipModel extends Model
{  
    protected $table            = 'membership';
    protected $primaryKey       = 'id_member'; 
    protected $allowedFields    = ['level_member', 'aktif', 'sampai', 'user_id'];
 
} 
