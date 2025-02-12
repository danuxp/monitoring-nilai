<?php

namespace App\Models;

use CodeIgniter\Model;

class MNilai extends Model
{
    protected $table            = 'nilai';
    protected $allowedFields    = ['siswa_id', 'mapel_id', 'guru_id', 'kelas_id', 'tugas', 'uts', 'uas', 'tahun_ajaran_id'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_siswa($kelas_id, $mapel_id, $guru_id)
    {
        $builder = $this->db->table('nilai n');
        $builder->select('n.*, s.nis, s.nama, s.jenis_kelamin');
        $builder->join('siswa s', 's.id = n.siswa_id');
        $where = [
            'n.kelas_id' => $kelas_id,
            'n.mapel_id' => $mapel_id,
            'n.guru_id' => $guru_id
        ];
        $builder->orderBy('s.nama', 'ASC');
        $builder->where($where);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function get_check_data($kelas_id, $kelas, $mapel_id, $id_guru)
    {
        $msiswa = new MSiswa();
        $get_nilai_siswa = $this->get_siswa($kelas_id, $mapel_id, $id_guru);
        $get_siswa = $msiswa->orderBy('nama', 'ASC')->where('kelas', $kelas)->findAll();
        if (empty($get_nilai_siswa)) {
            $get_data = $get_siswa;
            $aksi = 0;
        } else {
            $get_data = $get_nilai_siswa;
            $aksi = 1;
        }

        $data = [
            'data' => $get_data,
            'aksi' => $aksi
        ];

        return $data;
    }

    public function jumlah_nilai($id_guru)
    {
        $mjadwal = new MJadwal();
        $data_jadwal = $mjadwal->get_data_jadwal($id_guru);
        $belum_nilai = 0;
        $sudah_nilai = 0;
        foreach ($data_jadwal as $row) {
            $where = [
                "mapel_id" => $row['mapel_id'],
                "kelas_id" => $row['kelas_id'],
                "tahun_ajaran_id" => $row['tahun_ajaran_id'],
                "guru_id" => $id_guru
            ];
            $check_nilai = $this->db->table($this->table)->where($where)->get()->getNumRows();
            if ($check_nilai > 0) {
                $sudah_nilai++;
            } else {
                $belum_nilai++;
            }
        }
        $data = [
            "sudah_nilai" => $sudah_nilai,
            "belum_nilai" => $belum_nilai
        ];

        return $data;
    }

    public function get_nilai_siswa($id_siswa)
    {
        $msiswa = new MSiswa();
        $mjadwal = new MJadwal();
        $get_siswa = $msiswa->get_siswa($id_siswa);
        $kelas = $get_siswa['kelas'];
        $get_jadwal = $mjadwal->get_data_jadwal($kelas);
        $result_nilai = [];

        $belum_nilai = 0;
        $sudah_nilai = 0;

        foreach ($get_jadwal as $row) {
            $where = [
                "siswa_id" => $id_siswa,
                "mapel_id" => $row['mapel_id'],
                "kelas_id" => $row['kelas_id']
            ];

            $nilai = $this->db->table($this->table)->where($where)->get()->getRowArray();

            $row['tugas'] = null;
            $row['uts'] = null;
            $row['uas'] = null;

            if ($nilai) {
                $row['tugas'] = $nilai['tugas'];
                $row['uts'] = $nilai['uts'];
                $row['uas'] = $nilai['uas'];
                $sudah_nilai++;
            } else {
                $belum_nilai++;
            }
            $result_nilai[] = $row;
        }
        $data = [
            "data" => $result_nilai,
            "belum_nilai" => $belum_nilai,
            "sudah_nilai" => $sudah_nilai
        ];

        return $data;
    }
}
