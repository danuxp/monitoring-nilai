<?php

namespace App\Models;

use CodeIgniter\Model;

class MJadwal extends Model
{
    protected $table            = 'jadwal';
    protected $allowedFields    = ['mapel_id', 'kelas_id', 'guru_id', 'hari', 'tahun_ajaran_id', 'jam_ke'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_jadwal($limit = '')
    {
        $builder = $this->db->table($this->table . ' j');
        $builder->select('j.*, m.nama_mapel, k.nama_kelas, g.nama, t.tahun, t.tahun_id');
        $builder->join('mapel m', 'm.id = j.mapel_id');
        $builder->join('kelas k', 'k.id = j.kelas_id');
        $builder->join('guru g', 'g.id = j.guru_id');
        $builder->join('tahun_ajaran t', 't.id = j.tahun_ajaran_id');
        if ($limit != '') {
            $builder->limit($limit);
        }
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function get_data_jadwal($param, $limit = '')
    {
        $builder = $this->db->table($this->table . ' j');
        $builder->select('j.*, m.nama_mapel, k.nama_kelas, g.nama, t.tahun, t.tahun_id');
        $builder->join('mapel m', 'm.id = j.mapel_id');
        $builder->join('kelas k', 'k.id = j.kelas_id');
        $builder->join('guru g', 'g.id = j.guru_id');
        $builder->join('tahun_ajaran t', 't.id = j.tahun_ajaran_id');
        $builder->orderBy("
        CASE 
            WHEN j.hari = 'Senin' THEN 1
            WHEN j.hari = 'Selasa' THEN 2
            WHEN j.hari = 'Rabu' THEN 3
            WHEN j.hari = 'Kamis' THEN 4
            WHEN j.hari = 'Jumat' THEN 5
            WHEN j.hari = 'Sabtu' THEN 6
            WHEN j.hari = 'Minggu' THEN 7
        END
    ", 'ASC');
        $builder->orderBy('j.jam_ke', 'ASC');
        if ($limit != '') {
            $builder->limit($limit);
        }
        if (session('role') == 2 || session('role') == 1) {
            $builder->where('j.guru_id', $param);
        } else {
            $builder->where('k.nama_kelas', $param);
        }
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function get_jadwal_siswa($kelas, $limit = '')
    {
        $builder = $this->db->table($this->table . ' j');
        $builder->select('j.*, m.nama_mapel, k.nama_kelas, g.nama, t.tahun, t.tahun_id');
        $builder->join('mapel m', 'm.id = j.mapel_id');
        $builder->join('kelas k', 'k.id = j.kelas_id');
        $builder->join('guru g', 'g.id = j.guru_id');
        $builder->join('tahun_ajaran t', 't.id = j.tahun_ajaran_id');
        $builder->orderBy("
        CASE 
            WHEN j.hari = 'Senin' THEN 1
            WHEN j.hari = 'Selasa' THEN 2
            WHEN j.hari = 'Rabu' THEN 3
            WHEN j.hari = 'Kamis' THEN 4
            WHEN j.hari = 'Jumat' THEN 5
            WHEN j.hari = 'Sabtu' THEN 6
            WHEN j.hari = 'Minggu' THEN 7
        END
    ", 'ASC');
        $builder->orderBy('j.jam_ke', 'ASC');
        if ($limit != '') {
            $builder->limit($limit);
        }
        $builder->where('k.nama_kelas', $kelas);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function jumlah_jadwal($id_guru, $id_tahun = '')
    {
        $tahun_ajaran = $this->db->table('tahun_ajaran')->where('status', 1)->get()->getRowArray();
        if ($id_tahun != '') {
            $id_tahun = $tahun_ajaran['id'];
        }
        $builder = $this->db->table($this->table);
        $builder->where('tahun_ajaran_id', $id_tahun);
        $builder->where('guru_id', $id_guru);
        $query = $builder->get()->getNumRows();
        return $query;
    }
}
