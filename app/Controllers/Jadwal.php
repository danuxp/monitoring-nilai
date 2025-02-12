<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MGuru;
use App\Models\MJadwal;
use App\Models\MKelas;
use App\Models\MMapel;
use App\Models\MSiswa;
use App\Models\MTahunAjaran;

class Jadwal extends BaseController
{
    protected $mkelas;
    protected $mmapel;
    protected $mtahun;
    protected $mguru;
    protected $mjadwal;
    protected $msiswa;
    public function __construct()
    {
        $this->mkelas = new MKelas();
        $this->mmapel = new MMapel();
        $this->mtahun = new MTahunAjaran();
        $this->mguru = new MGuru();
        $this->mjadwal = new MJadwal();
        $this->msiswa = new MSiswa();
    }

    public function index()
    {

        $role = session('role');
        if ($role == 1) {
            $data = [
                "title" => "Data Jadwal",
                "data" => $this->mjadwal->get_jadwal()

            ];
            $this->template->display('jadwal/index', $data);
        } else if ($role == 2) {
            $this->guru();
        } else {
            $this->siswa();
        }
    }

    public function form($id = '')
    {
        $get_jadwal = $this->mjadwal->find($id);
        $hari_list = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

        $data = [
            "title" => "Form Jadwal",
            "kelas" => $this->mkelas->where('status', 1)->findAll(),
            "mapel" => $this->mmapel->where('status', 1)->findAll(),
            "guru" => $this->mguru->where('status', 'A')->findAll(),
            "tahun" => $this->mtahun->where('status', 1)->first(),
            "data" => $get_jadwal,
            "jam_ke" => jam_ke(),
            "hari" => $hari_list
        ];
        $this->template->display('jadwal/form', $data);
    }

    public function save()
    {
        $mapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $guru = $this->request->getPost('guru');
        $hari = $this->request->getPost('hari');
        $tahun_ajaran = $this->mtahun->where('status', 1)->first();
        $id = $this->request->getPost('id');
        $jamke = $this->request->getPost('jamke');

        $data = [
            'mapel_id' => $mapel,
            'kelas_id' => $kelas,
            'guru_id' => $guru,
            'hari' => $hari,
            'jam_ke' => $jamke
        ];

        $text = "ditambah";
        $check_jadwal_kelas = $this->mjadwal->where(['kelas_id' => $kelas, 'hari' => $hari, 'jam_ke' => $jamke, 'tahun_ajaran_id' => $tahun_ajaran['id']])->first();

        if ($check_jadwal_kelas) {
            $response = ["title" => "Gagal", "text" => "Jadwal di kelas tersebut pada hari $hari sudah ada, silahkan pilih jam lain", "icon" => "error"];
            session()->setFlashdata($response);
            return redirect()->back();
        }

        if ($id) {
            $data['id'] = $id;
            $text = "diupdate";
        } else {
            $check_jadwal = $this->mjadwal->where(['mapel_id' => $mapel, 'guru_id' => $guru, 'kelas_id' => $kelas])->first();
            if ($check_jadwal) {
                $response = ["title" => "Gagal", "text" => "Data gagal $text, Jadwal sudah ada", "icon" => "error"];
                session()->setFlashdata($response);
                return redirect()->back();
            }

            $data['tahun_ajaran_id'] = $tahun_ajaran['id'];
        }


        try {
            $this->mjadwal->save($data);
            $response = ["title" => "Berhasil", "text" => "Data berhasil $text", "icon" => "success"];
        } catch (\Throwable $th) {
            $response = ["title" => "Gagal", "text" => "Data gagal $text", "icon" => "error"];
        }

        session()->setFlashdata($response);
        return redirect()->to('jadwal');
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            try {
                $id = $this->request->getPost('id');
                $this->mjadwal->delete($id);
                $response = [
                    'title' => 'Berhasil',
                    'text' => 'Data berhasil dihapus',
                    'type' => 'success'
                ];
            } catch (\Throwable $th) {
                $response = [
                    'title' => 'Gagal',
                    'text' => 'Data gagal dihapus',
                    'type' => 'error'
                ];
            }
            return $this->response->setJSON($response);
        } else {
            return redirect()->to('404');
        }
    }

    protected function guru()
    {
        $id_guru = session('id_guru');
        $get_jadwal = $this->mjadwal->get_data_jadwal($id_guru);
        $result_jadwal = [];
        foreach ($get_jadwal as $row) {
            $result_jadwal[$row['hari']][] = $row;
        }
        $data = [
            "title" => "Jadwal Mengajar",
            "data" => $result_jadwal
        ];

        $this->template->display('jadwal/guru', $data);
    }

    protected function siswa()
    {
        $id_siswa = session('id_siswa');
        $get_siswa = $this->msiswa->get_siswa($id_siswa);
        $kelas = $get_siswa['kelas'];
        $get_jadwal = $this->mjadwal->get_data_jadwal($kelas);
        $result_jadwal = [];
        foreach ($get_jadwal as $row) {
            $result_jadwal[$row['hari']][] = $row;
        }
        $data = [
            "title" => "Jadwal Kelas " . $kelas,
            "data" => $result_jadwal
        ];

        $this->template->display('jadwal/siswa', $data);
    }
}
