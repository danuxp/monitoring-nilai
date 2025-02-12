<?php

namespace App\Models;

use CodeIgniter\Model;

class MSiswa extends Model
{
    protected $table            = 'siswa';
    protected $allowedFields    = ['id_user', 'nis', 'nama', 'jenis_kelamin', 'agama', 'tempat', 'tgl_lahir', 'alamat', 'nama_ibu', 'nama_ayah', 'no_hp', 'kelas', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function create_siswa($data, $data_user)
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

    public function get_siswa($id = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, users.email, kelas.id as id_kelas');
        $builder->join('users', 'users.id = siswa.id_user');
        $builder->join('kelas', 'kelas.nama_kelas = siswa.kelas', 'left');
        if ($id == false) {
            $query = $builder->get()->getResultArray();
        } else {
            $query = $builder->getWhere(['siswa.id' => $id])->getRowArray();
        }
        return $query;
    }
}
