<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanMasukModel extends Model
{

    protected $table = "pesanmasuk";
    protected $primaryKey = 'id_pesanMasuk';
    protected $allowedFields = ['nama_user','email','jenis_member','bulan', 'status', 'waktu_pesan', 'waktu_bayar','user_id'];
}
