<?php

namespace App\Models;

use CodeIgniter\Model;

class MGuru extends Model
{
    protected $table            = 'guru';
    protected $allowedFields    = ['id_user', 'nuptk', 'nama', 'jenis_kelamin', 'tempat', 'tgl_lahir', 'alamat', 'no_hp', 'agama', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function create_guru($data, $data_user)
    {
        $builder = $this->db->table($this->table);
        try {
            $this->db->transException(true)->transStart();
            $this->db->table('users')->insert($data_user);
            $insertID = $this->db->insertID();
            $data['id_user'] = $insertID;
            $builder->insert($data);
            $this->db->transComplete();
        } catch (\Throwable $th) {
            $this->db->transRollback();
        }

        return $this->db->transStatus();
    }

    public function get_guru($id = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('guru.*, users.email');
        $builder->join('users', 'users.id = guru.id_user');
        if ($id == false) {
            $query = $builder->get()->getResultArray();
        } else {
            $query = $builder->getWhere(['guru.id' => $id])->getRowArray();
        }
        return $query;
    }
}
