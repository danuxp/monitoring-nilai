<?php

namespace App\Models;

use CodeIgniter\Model;

class MMapel extends Model
{
    protected $table            = 'mapel';
    protected $allowedFields    = ['nama_mapel', 'status', 'id_kelas'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_mapel($id = '')
    {
        $builder = $this->db->table($this->table . ' m');
        $builder->select('m.*');
        if ($id === false) {
            $builder->where('m.id', $id);
            $query = $builder->get()->getRowArray();
        } else {
            $query = $builder->get()->getResultArray();
        }
        return $query;
    }
}
