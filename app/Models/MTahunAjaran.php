<?php

namespace App\Models;

use CodeIgniter\Model;

class MTahunAjaran extends Model
{
    protected $table            = 'tahun_ajaran';
    protected $allowedFields    = ["tahun", "tahun_id", "start_date", "end_date", "status"];
}
