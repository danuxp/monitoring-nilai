<?php

namespace App\Models;

use CodeIgniter\Model;

class MSetting extends Model
{
    protected $table            = 'setting';
    protected $allowedFields    = ['nama', 'slogan', 'logo'];
}
