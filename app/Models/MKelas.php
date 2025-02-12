<?php

namespace App\Models;

use CodeIgniter\Model;

class MKelas extends Model
{
    protected $table            = 'kelas';
    protected $allowedFields    = ['nama_kelas', 'status'];
}
