<?php

namespace App\Models;

use CodeIgniter\Model;

class InformasiModel extends Model
{
    protected $table            = 'informasi';
    protected $primaryKey       = 'id_informasi';
    protected $allowedFields    = ['tgl_buka','tgl_tutup','tgl_pengumuman'];
    // Dates
    protected $useTimestamps = false;
}