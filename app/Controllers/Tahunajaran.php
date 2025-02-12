<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MTahunAjaran;
use CodeIgniter\HTTP\ResponseInterface;

class Tahunajaran extends BaseController
{
    protected $mtahun;
    public function __construct()
    {
        $this->mtahun = new MTahunAjaran();
    }

    public function index()
    {
        $bulan = date('n');
        $tahun = date('Y');
        if ($bulan > 7) {
            $tahun_id = $tahun . '/' . $tahun + 1;
        } else {
            $tahun_id = $tahun - 1 . '/' . $tahun;
        }

        $data = [
            "title" => "Data Tahun Ajaran",
            "tahun_id" => $tahun_id,
            "data" => $this->mtahun->findAll()
        ];
        $this->template->display('tahun_ajaran', $data);
    }

    public function save()
    {
        $tahun = $this->request->getPost('tahun');
        $tahun_id = $this->request->getPost('tahun_id');
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');

        $check_tahun = $this->mtahun->where(['tahun' => $tahun, 'tahun_id' => $tahun_id])->first();

        if ($check_tahun != null) {
            $response = [
                "title" => "Peringatan",
                "text" => "Data tahun ajaran sudah ada",
                "icon" => "warning"
            ];
            session()->setFlashdata($response);
            return redirect()->back();
        }


        $data = [
            "tahun" => $tahun,
            "tahun_id" => $tahun_id,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "status" => 1
        ];

        try {
            $this->mtahun->save($data);
            $response = [
                "title" => "Berhasil",
                "text" => "Data tahun ajaran berhasil disimpan",
                "icon" => "success"
            ];
        } catch (\Throwable $th) {
            $response = [
                "title" => "Berhasil",
                "text" => "Data tahun ajaran berhasil disimpan",
                "icon" => "success"
            ];
        }
        session()->setFlashdata($response);
        return redirect()->back();
    }

    public function edit()
    {
        $id = $this->request->getPost('id');
        $tahun = $this->request->getPost('tahun');
        $tahun_id = $this->request->getPost('tahun_id');
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');
        $status = $this->request->getPost('status');

        $data = [
            "id" => $id,
            "tahun" => $tahun,
            "tahun_id" => $tahun_id,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "status" => $status == null ? 0 : 1
        ];

        try {
            $this->mtahun->save($data);
            $response = [
                "title" => "Berhasil",
                "text" => "Data tahun ajaran berhasil diupdate",
                "icon" => "success"
            ];
        } catch (\Throwable $th) {
            $response = [
                "title" => "Berhasil",
                "text" => "Data tahun ajaran berhasil diupdate",
                "icon" => "success"
            ];
        }
        session()->setFlashdata($response);
        return redirect()->back();
    }

    public function hapus()
    {
        try {
            $id = $this->request->getPost('id');
            $this->mtahun->delete($id);
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
    }

    public function get_ajax()
    {
        $id = $this->request->getPost('id');
        try {
            $data = $this->mtahun->find($id);
        } catch (\Throwable $th) {
            $data = [];
        }
        return $this->response->setJSON($data);
    }
}
