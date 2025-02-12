<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MKelas;
use App\Models\MSiswa;
use App\Models\MUsers;

class Siswa extends BaseController
{
    protected $msiswa;
    protected $mkelas;
    protected $musers;
    public function __construct()
    {
        $this->msiswa = new MSiswa();
        $this->mkelas = new MKelas();
        $this->musers = new MUsers();
    }

    public function index()
    {
        $data = [
            "title" => "Data Siswa",
            "data" => $this->msiswa->get_siswa()
        ];
        $this->template->display('siswa/index', $data);
    }

    public function form($id = null)
    {
        $agama = [
            "Islam",
            "Kristen",
            "Katolik",
            "Hindu",
            "Buddha",
            "Konghucu"
        ];

        $kelas = $this->mkelas->where('status', 1)->findAll();

        $get_siswa = $this->msiswa->get_siswa($id);

        $url_to =  $id == null ? 'siswa/save' : 'siswa/update/' . $id;

        $data = [
            "title" => "Form Siswa",
            "agama" => $agama,
            "kelas" => $kelas,
            "data" => $get_siswa,
            "url_to" => $url_to

        ];
        $this->template->display('siswa/form', $data);
    }

    protected function rules()
    {
        $rules = [
            'nis' => [
                'rules' => ['required', 'numeric', 'is_unique[siswa.nis]'],
                'errors' => [
                    'required' => 'Nis sekolah tidak boleh kosong',
                    'numeric' => 'Nis harus angka',
                    'is_unique' => 'Nis sudah terdaftar'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin tidak boleh kosong',
                ]
            ],
            'tempat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat tidak boleh kosong',
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir tidak boleh kosong',
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama tidak boleh kosong',
                ]
            ],
            'email' => [
                'rules' => ['required', 'valid_email'],
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
        ];
        return $rules;
    }

    public function save()
    {
        $rules = $this->rules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $nis = $this->request->getPost('nis');
        $nama = $this->request->getPost('nama');
        $jk = $this->request->getPost('jk');
        $tempat = $this->request->getPost('tempat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $ayah = $this->request->getPost('ayah') ?? null;
        $ibu = $this->request->getPost('ibu') ?? null;
        $alamat = $this->request->getPost('alamat') ?? null;
        $no_hp = $this->request->getPost('no_hp') ?? null;
        $email = $this->request->getPost('email');
        $agama = $this->request->getPost('agama');
        $kelas = $this->request->getPost('kelas') ?? null;

        $data = [
            "nis" => $nis,
            "nama" => strtoupper($nama),
            "jenis_kelamin" => $jk,
            "tempat" => strtoupper($tempat),
            "tgl_lahir" => $tgl_lahir,
            "agama" => $agama,
            "alamat" => $alamat,
            "nama_ibu" => $ibu,
            "nama_ayah" => $ayah,
            "no_hp" => $no_hp,
            "kelas" => $kelas,
        ];

        $data_user = [
            "username" => $nis,
            "email" => $email,
            "password" => password_hash($nis, PASSWORD_DEFAULT),
            "role" => 3
        ];

        try {
            $this->msiswa->create_siswa($data, $data_user);
            $response = ["title" => "Berhasil", "text" => "Data berhasil disimpan", "icon" => "success"];
        } catch (\Throwable $th) {
            $response = ["title" => "Gagal", "text" => "Data gagal disimpan", "icon" => "error"];
        }

        session()->setFlashdata($response);
        return redirect()->to('siswa');
    }

    public function update($id)
    {
        $rules = $this->rules();
        unset($rules['nis']['rules'][2]);
        unset($rules['nis']['errors']['is_unique']);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }
        $nis = $this->request->getPost('nis');
        $nama = $this->request->getPost('nama');
        $jk = $this->request->getPost('jk');
        $tempat = $this->request->getPost('tempat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $ayah = $this->request->getPost('ayah') ?? null;
        $ibu = $this->request->getPost('ibu') ?? null;
        $alamat = $this->request->getPost('alamat') ?? null;
        $no_hp = $this->request->getPost('no_hp') ?? null;
        $email = $this->request->getPost('email');
        $agama = $this->request->getPost('agama');
        $kelas = $this->request->getPost('kelas') ?? null;
        $id_user = $this->request->getPost('id_user');

        $data = [
            "id" => $id,
            "nis" => $nis,
            "nama" => strtoupper($nama),
            "jenis_kelamin" => $jk,
            "tempat" => strtoupper($tempat),
            "tgl_lahir" => $tgl_lahir,
            "agama" => $agama,
            "alamat" => $alamat,
            "nama_ibu" => $ibu,
            "nama_ayah" => $ayah,
            "no_hp" => $no_hp,
            "kelas" => $kelas,
        ];

        $data_user = [
            "id" => $id_user,
            "email" => $email
        ];

        try {
            $this->db->transException(true)->transStart();
            $this->msiswa->save($data);
            $this->musers->save($data_user);
            $this->db->transComplete();
            $response = ["title" => "Berhasil", "text" => "Data berhasil diupdate", "icon" => "success"];
        } catch (\Throwable $th) {
            $this->db->transRollback();
            $response = ["title" => "Gagal", "text" => "Data gagal diupdate", "icon" => "error"];
        }

        session()->setFlashdata($response);
        return redirect()->to('siswa');
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $get_data = $this->msiswa->find($id);
            try {
                $this->db->transException(true)->transStart();
                $this->musers->delete($get_data['id_user']);
                $this->msiswa->delete($id);
                $this->db->transComplete();
                $response = ["title" => "Berhasil", "text" => "Data berhasil dihapus", "type" => "success"];
            } catch (\Throwable $th) {
                $this->db->transRollback();
                $response = ["title" => "Gagal", "text" => "Data gagal dihapus", "type" => "error"];
            }
            return $this->response->setJSON($response);
        } else {
            // $response = ["title" => "Gagal", "text" => "Data gagal dihapus", "type" => "error"];
            return redirect()->to('404');
        }
    }
}
