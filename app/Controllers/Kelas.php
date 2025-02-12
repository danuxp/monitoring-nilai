<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MKelas;
use CodeIgniter\HTTP\ResponseInterface;

class Kelas extends BaseController
{
    protected $mkelas;
    public function __construct()
    {
        $this->mkelas = new MKelas();
    }

    public function index()
    {
        $data = [
            "title" => "Data Kelas",
            "data" => $this->mkelas->orderBy('nama_kelas', 'ASC')->findAll()
        ];
        $this->template->display('kelas', $data);
    }

    public function save()
    {
        $rules = [
            'nama_kelas' => [
                'rules' => ['required'],
                'errors' => [
                    'required' => 'Nama kelas tidak boleh kosong',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $error = validation_errors('nama_kelas');
            $res = [
                'status' => 500,
                'title' => 'Gagal',
                'text' => $error['nama_kelas'],
                'type' => 'error'

            ];
            return $this->response->setJSON($res);
        }

        $id = $this->request->getPost('id');
        $nama_kelas = $this->request->getPost('nama_kelas');
        $status = empty($id) ? 1 : $this->request->getPost('status');

        $data = [
            'nama_kelas' => strtoupper($nama_kelas),
            'status' => $status
        ];

        if (!empty($id)) {
            $data['id'] = $id;
            $text = 'diedit';
        } else {
            $text = 'disimpan';
        }

        try {
            $this->mkelas->save($data);
            $res = [
                'status' => 200,
                'title' => 'Berhasil',
                'text' => 'Data berhasil ' . $text,
                'type' => 'success'
            ];
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'title' => 'Gagal',
                'text' => 'Data gagal disimpan',
                'type' => 'error'
            ];
        }

        return $this->response->setJSON($res);
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            try {
                $id = $this->request->getPost('id');
                $this->mkelas->delete($id);
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
