<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MGuru;
use App\Models\MUsers;

class Guru extends BaseController
{
    protected $mguru;
    protected $musers;
    public function __construct()
    {
        $this->mguru = new MGuru();
        $this->musers = new MUsers();
    }

    public function index()
    {
        $data = [
            "title" => "Data Guru",
            "data" => $this->mguru->get_guru()
        ];
        $this->template->display('guru/index', $data);
    }

    protected function rules()
    {
        // 'numeric',
        $rules = [
            'nuptk' => [
                'rules' => ['is_unique[guru.nuptk]'],
                'errors' => [
                    // 'numeric' => 'Nuptk harus angka',
                    'is_unique' => 'Nuptk sudah terdaftar'
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
            'password' => [
                'rules' => ['required', 'min_length[8]'],
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 8 karakter'
                ]
            ],
        ];
        return $rules;
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

        $get_guru = $this->mguru->get_guru($id);

        $url_to =  $id == null ? 'guru/save' : 'guru/update/' . $id;

        $data = [
            "title" => "Form Guru",
            "agama" => $agama,
            "data" => $get_guru,
            "url_to" => $url_to
        ];

        $this->template->display('guru/form', $data);
    }

    public function save()
    {
        $rules = $this->rules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }


        $nuptk = $this->request->getPost('nuptk') ?? null;
        $nama = $this->request->getPost('nama');
        $jk = $this->request->getPost('jk');
        $tempat = $this->request->getPost('tempat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $alamat = $this->request->getPost('alamat') ?? null;
        $no_hp = $this->request->getPost('no_hp') ?? null;
        $email = $this->request->getPost('email');
        $agama = $this->request->getPost('agama');
        $password = $this->request->getPost('password');

        $data = [
            "nuptk" => $nuptk,
            "nama" => strtoupper($nama),
            "jenis_kelamin" => $jk,
            "tempat" => strtoupper($tempat),
            "tgl_lahir" => $tgl_lahir,
            "agama" => $agama,
            "alamat" => $alamat,
            "no_hp" => $no_hp,
            "status" => 'A'
        ];

        $data_user = [
            "username" => $nuptk ?? $email,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "role" => 2
        ];


        try {
            $this->mguru->create_guru($data, $data_user);
            $response = ["title" => "Berhasil", "text" => "Data berhasil disimpan", "icon" => "success"];
        } catch (\Throwable $th) {
            $response = ["title" => "Gagal", "text" => "Data gagal disimpan", "icon" => "error"];
        }

        session()->setFlashdata($response);
        return redirect()->to('guru');
    }

    public function update($id)
    {
        $rules = $this->rules();

        unset($rules['password']);
        unset($rules['nuptk']['rules'][1]);
        unset($rules['nuptk']['errors']['is_unique']);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $nuptk = $this->request->getPost('nuptk') ?? null;
        $nama = $this->request->getPost('nama');
        $jk = $this->request->getPost('jk');
        $tempat = $this->request->getPost('tempat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $alamat = $this->request->getPost('alamat') ?? null;
        $no_hp = $this->request->getPost('no_hp') ?? null;
        $email = $this->request->getPost('email');
        $agama = $this->request->getPost('agama');

        $id_user = $this->request->getPost('id_user');

        $data = [
            "id" => $id,
            "nuptk" => $nuptk,
            "nama" => strtoupper($nama),
            "jenis_kelamin" => $jk,
            "tempat" => strtoupper($tempat),
            "tgl_lahir" => $tgl_lahir,
            "agama" => $agama,
            "alamat" => $alamat,
            "no_hp" => $no_hp,
        ];

        $data_user = [
            "id" => $id_user,
            "email" => $email,
        ];

        try {
            $this->db->transException(true)->transStart();
            $this->mguru->save($data);
            $this->musers->save($data_user);
            $this->db->transComplete();
            $response = ["title" => "Berhasil", "text" => "Data berhasil diupdate", "icon" => "success"];
        } catch (\Throwable $th) {
            $this->db->transRollback();
            $response = ["title" => "Gagal", "text" => "Data gagal diupdate", "icon" => "success"];
        }
        session()->setFlashdata($response);
        return redirect()->back();
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $get_data = $this->mguru->find($id);
            try {
                $this->db->transException(true)->transStart();
                $this->musers->delete($get_data['id_user']);
                $this->mguru->delete($id);
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

    public function generate()
    {
        if ($this->request->isAJAX()) {
            $password = random_string('alnum', 8);
            echo $password;
        } else {
            redirect()->to('404');
        }
    }
}
