<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MKelas;
use App\Models\MMapel;
use CodeIgniter\HTTP\ResponseInterface;

class Mapel extends BaseController
{
    protected $mmapel;
    protected $mkelas;
    public function __construct()
    {
        $this->mmapel = new MMapel();
        $this->mkelas = new MKelas();
    }
    public function index()
    {
        $data = [
            "title" => "Data Mata Pelajaran",
            "data" => $this->mmapel->findAll(),
        ];
        $this->template->display('mapel', $data);
    }

    public function save()
    {
        $mapel = $this->request->getPost('mapel');
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');


        $data = [
            'nama_mapel' => ucwords($mapel)
        ];

        if (empty($id)) {
            $data['status'] = 1;
            $text = "ditambahkan";
        } else {
            $text = "diupdate";
            $data['status'] = $status == null ? 0 : 1;
            $data['id'] = $id;
        }

        // return $this->response->setJSON($data);

        try {
            $this->mmapel->save($data);
            $response = [
                "title" => "Berhasil",
                "text" => "Data berhasil {$text}",
                "icon" => "success"
            ];
        } catch (\Throwable $th) {
            $response = ["title" => "Gagal", "text" => "Data gagal {$text}", "icon" => "error"];
            //throw $th;
        }
        session()->setFlashdata($response);
        return redirect()->back();
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            try {
                $id = $this->request->getPost('id');
                $this->mmapel->delete($id);
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
}
