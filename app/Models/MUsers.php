<?php

namespace App\Models;

use CodeIgniter\Model;

class MUsers extends Model
{
    protected $table            = 'users';
    protected $allowedFields    = ['username', 'password', 'email', 'role'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_user($param)
    {
        $builder = $this->db->table('users u');
        $builder->select('u.id as id_user, u.username, u.password, u.role, u.email, s.id as id_siswa, s.nis, s.nama as nama_siswa, g.id as id_guru, g.nuptk, g.nama as nama_guru');
        $builder->join('siswa s', 's.id_user = u.id', 'left');
        $builder->join('guru g', 'g.id_user = u.id', 'left');
        $user  = $this->db->escape($param);
        $where = "u.username = {$user} or u.email = {$user} or s.nis = {$user} or g.nuptk = {$user}";
        $builder->where($where);
        $query = $builder->get()->getRowArray();
        return $query;
    }

    public function get_role_users($role)
    {
        $builder = $this->db->table('users u');
        $builder->select('u.*, s.nama as nama_siswa, g.nama as nama_guru');
        $builder->join('siswa s', 's.id_user = u.id', 'left');
        $builder->join('guru g', 'g.id_user = u.id', 'left');
        $builder->where('u.role', $role);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
