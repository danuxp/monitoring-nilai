<?php

namespace App\Controllers;

use App\Models\MGuru;
use App\Models\MJadwal;
use App\Models\MNilai;
use App\Models\MSiswa;

class Dashboard extends BaseController
{
    protected $mjadwal;
    protected $mnilai;
    protected $msiswa;
    protected $mguru;
    public function __construct()
    {
        $this->mjadwal = new MJadwal();
        $this->mnilai = new MNilai();
        $this->msiswa = new MSiswa();
        $this->mguru = new MGuru();
    }

    public function admin()
    {
        $data = [
            "title" => "Dashboard Admin",
            "jumlah_siswa" => $this->msiswa->countAllResults(),
            "jumlah_guru" => $this->mguru->countAllResults(),
            "jumlah_jadwal" => $this->mjadwal->countAllResults(),
            "data_siswa" => $this->msiswa->limit(5)->findAll(),
            "data_guru" => $this->mguru->limit(5)->findAll(),
            "data_jadwal" => $this->mjadwal->get_jadwal(5),
        ];
        // return $this->response->setJSON($data['data_jadwal']);
        $this->template->display('dashboard/admin', $data);
    }

    public function guru()
    {
        $id_guru = session('id_guru');

        $data = [
            "title" => "Dashboard Guru",
            "jadwal" => $this->mjadwal->get_data_jadwal($id_guru, 5),
            "jumlah_jadwal" => $this->mjadwal->jumlah_jadwal($id_guru),
            "jumlah_nilai" => $this->mnilai->jumlah_nilai($id_guru),
            "mnilai" => $this->mnilai,
        ];
        $this->template->display('dashboard/guru', $data);
    }

    public function siswa()
    {
        $id_siswa = session('id_siswa');

        $get_siswa = $this->msiswa->get_siswa($id_siswa);

        $get_data = $this->mnilai->get_nilai_siswa($id_siswa);

        $data = [
            "title" => "Dashboard Siswa",
            "jadwal" => $this->mjadwal->get_data_jadwal($get_siswa['kelas'], 5),
            "jumlah_jadwal" => count($get_data['data']),
            "belum_nilai" => $get_data['belum_nilai'],
            "sudah_nilai" => $get_data['sudah_nilai']
        ];
        $this->template->display('dashboard/siswa', $data);
    }

    public function error404()
    {
        return view('404');
    }
}
