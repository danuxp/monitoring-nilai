<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MGuru;
use App\Models\MJadwal;
use App\Models\MNilai;
use App\Models\MSiswa;
use App\Models\MTahunAjaran;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Nilai extends BaseController
{
    protected $mjadwal;
    protected $msiswa;
    protected $mnilai;
    protected $mguru;
    protected $mtahun;

    public function __construct()
    {
        $this->mjadwal = new MJadwal();
        $this->msiswa = new MSiswa();
        $this->mnilai = new MNilai();
        $this->mguru = new MGuru();
        $this->mtahun = new MTahunAjaran();
    }

    public function index()
    {
        $role = session('role');
        if ($role == 1) {
            $this->admin();
        } else if ($role == 2) {
            $id_guru = session('id_guru');
            $this->guru($id_guru);
        } else {
            $this->siswa();
        }
    }

    public function admin()
    {
        $data = [
            "title" => "Data Penilaian",
            "guru" => $this->mguru->where('status', 'A')->findAll()
        ];
        $this->template->display('nilai/index', $data);
    }

    public function guru($id_guru)
    {
        $get_jadwal = $this->mjadwal->get_data_jadwal($id_guru);

        $data = [
            "title" => "Penilaian",
            "data" => $get_jadwal,
            "mnilai" => $this->mnilai,
            "id_guru" => $id_guru
        ];
        if (session('id_guru')) {
            $this->template->display('nilai/guru', $data);
        } else {
            echo view('nilai/guru', $data);
            // echo "tes";
            // return $get_jadwal;
        }
    }

    protected function siswa()
    {
        $id_siswa = session('id_siswa');
        $result_nilai = $this->mnilai->get_nilai_siswa($id_siswa);

        $data = [
            "title" =>  "Data Nilai",
            "data" => $result_nilai['data']
        ];

        $this->template->display('nilai/siswa', $data);
    }

    public function get_data()
    {
        $id_guru = $this->request->getPost('id_guru');
        $this->guru($id_guru);

        // $get_jadwal = $this->mjadwal->get_data_jadwal($id_guru);

        // echo $data;
        // var_dump($get_jadwal);
        // echo $view;
    }

    public function form($param)
    {
        $dekrip_param = dekrip($param);
        $p = json_decode($dekrip_param, true);
        $id_guru = $p['id_guru'];

        $get_data = $this->mnilai->get_check_data($p['kelas_id'], $p['nama_kelas'], $p['mapel_id'], $id_guru);
        // return $this->response->setJSON($get_data);
        $data = [
            "title" => "Penilaian Mata Pelajaran",
            "param" => $p,
            "data" => $get_data['data'],
            "aksi" => $get_data['aksi']
        ];
        $this->template->display('nilai/penilaian', $data);
    }

    public function save()
    {
        $id_guru = $this->request->getPost('id_guru');
        $mapel_id = $this->request->getPost('mapel_id');
        $kelas_id = $this->request->getPost('kelas_id');
        $tahun_id = $this->request->getPost('tahun_id');
        $kelas = $this->request->getPost('kelas');
        $tugas = $this->request->getPost('tugas');
        $uts = $this->request->getPost('uts');
        $uas = $this->request->getPost('uas');
        $aksi = $this->request->getPost('aksi');
        $id = $this->request->getPost('id');

        $get_data = $this->mnilai->get_check_data($kelas_id, $kelas, $mapel_id, $id_guru);

        $data = [];

        foreach ($get_data['data'] as $value) {
            $id_siswa = isset($value['siswa_id']) ? $value['siswa_id'] : $value['id'];
            $nilai_tugas = $tugas[$id_siswa];
            $nilai_uts = $uts[$id_siswa];
            $nilai_uas = $uas[$id_siswa];

            if ($aksi == 0) {
                $data[] = [
                    'siswa_id' => $id_siswa,
                    'mapel_id' => $mapel_id,
                    'guru_id' => $id_guru,
                    'kelas_id' => $kelas_id,
                    'tahun_ajaran_id' => $tahun_id,
                    'tugas' => $nilai_tugas,
                    'uts' => $nilai_uts,
                    'uas' => $nilai_uas
                ];
            } else {
                $data[] = [
                    'id' => $id[$id_siswa],
                    'tugas' => $nilai_tugas,
                    'uts' => $nilai_uts,
                    'uas' => $nilai_uas
                ];
            }
        }

        try {
            if ($aksi == 0) {
                $this->mnilai->insertBatch($data);
                $text = "disimpan";
            } else {
                $this->mnilai->updateBatch($data, 'id');
                $text = "diupdate";
            }
            $response = [
                "title" => "Berhasil",
                "text" => "Nilai berhasil $text",
                "icon" => "success"
            ];
        } catch (\Throwable $th) {
            $response = [
                "title" => "Gagal",
                "text" => "Nilai gagal $text",
                "icon" => "error"
            ];
        }

        session()->setFlashdata($response);
        return redirect()->back();
    }

    public function export_excell($param)
    {
        $dekrip_param = dekrip($param);
        $p = json_decode($dekrip_param, true);
        $id_guru = $p['id_guru'];
        $data = $this->mnilai->get_check_data($p['kelas_id'], $p['nama_kelas'], $p['mapel_id'], $id_guru);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nis')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Nama Mata Pelajaran')
            ->setCellValue('E1', 'Kelas')
            ->setCellValue('F1', 'Nilai Tugas')
            ->setCellValue('G1', 'Nilai UTS')
            ->setCellValue('H1', 'Nilai UAS')
            ->setCellValue('I1', 'Nilai Akhir')
            ->setCellValue('J1', 'Nilai Abjad')
            ->setCellValue('K1', 'Predikat');
        $column = 2;
        $no = 1;

        foreach ($data['data'] as $row) {
            $nilai_akhir = nilai_akhir($row['tugas'], $row['uts'], $row['uas']);
            $nilai_abjad = range_nilai($nilai_akhir);
            $predikat = predikat_nilai($nilai_akhir);

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValueExplicit('B' . $column, $row['nis'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING)
                ->setCellValue('C' . $column, $row['nama'])
                ->setCellValue('D' . $column, $p['nama_mapel'])
                ->setCellValue('E' . $column, $p['nama_kelas'])
                ->setCellValue('F' . $column, $row['tugas'])
                ->setCellValue('G' . $column, $row['uts'])
                ->setCellValue('H' . $column, $row['uas'])
                ->setCellValue('I' . $column, $nilai_akhir)
                ->setCellValue('J' . $column, $nilai_abjad)
                ->setCellValue('K' . $column, $predikat['predikat']);
            $column++;
        }


        $writer = new Xlsx($spreadsheet);
        $fileName = date('Y-m-d') . '_Hasil Nilai_' . $p['nama_mapel'] . '_' . $p['nama_kelas'];

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
