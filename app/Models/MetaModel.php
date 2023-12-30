<?php

namespace App\Models;

use CodeIgniter\Model;

class MetaModel extends Model
{
    protected $table = "meta";
    protected $primaryKey = 'id_meta';
    protected $allowedFields = ['favicon','logo','title','description', 'keywords', 'alamat_toko', 'facebook','youtube', 'email'];
}
