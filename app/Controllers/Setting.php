<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MGuru;
use App\Models\MSetting;
use App\Models\MSiswa;
use App\Models\MUsers;
use CodeIgniter\HTTP\ResponseInterface;

class Setting extends BaseController
{
    protected $msetting;
    protected $mguru;
    protected $muser;
    protected $msiswa;
    public function __construct()
    {
        $this->msetting = new MSetting();
        $this->muser = new MUsers();
        $this->mguru = new MGuru();
        $this->msiswa = new MSiswa();
    }
    public function index()
    {
        $role = session('role');

        if ($role == 1) {
            $get_setting = $this->msetting->first();
            $user_id = session('user_id');
            $get_user = $this->muser->find($user_id);
            $data = [
                "title" => "Setting",
                "data" => $get_setting,
                "user" => $get_user
            ];
            $this->template->display('setting', $data);
        } else if ($role == 2) {
            $this->setting_guru();
        } else {
            $this->setting_siswa();
        }
    }

    public function save()
    {
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $slogan = $this->request->getPost('slogan');
        $logo = $this->request->getFile('logo');
        // $logo_lama = $this->request->getFile('logo_lama');

        $get_setting = $this->msetting->first();

        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama sekolah tidak boleh kosong',
                ]
            ],
            'slogan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Slogan tidak boleh kosong',
                ]
            ],

            'logo' => [
                'rules' => ['is_image[logo]', 'max_size[logo, 2048]', 'mime_in[logo,image/png,image/jpeg,image/jpg]'],
                'errors' => [
                    'uploaded' => 'Logo tidak boleh kosong',
                    'max_size' => 'Maksimal size 2 MB',
                    'mime_in' => 'Format file yang diupload harus png/jpeg/jpg',
                    'is_image' => 'Logo harus berupa gambar'
                ]
            ],
        ];

        $data = [
            'nama' => strtoupper($nama),
            'slogan' => $slogan,
        ];

        if (!$get_setting) {
            $rules['logo']['rules'][] = 'uploaded[logo]';
        } else {
            $data['id'] = $id;
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        } else {
            if ($logo && $logo->isValid() && !$logo->hasMoved()) {
                $filename = $logo->getRandomName();

                $data['logo'] = $filename;

                $logo->move(ROOTPATH . 'public/img', $filename);


                if (file_exists(ROOTPATH . 'public/img/' . $get_setting['logo'])) {
                    unlink(ROOTPATH . 'public/img/' . $get_setting['logo']);
                }
            }

            try {
                $this->msetting->save($data);
                $response = ["title" => "Berhasil", "text" => "Data berhasil disimpan", "icon" => "success"];
            } catch (\Throwable $th) {
                $response = ["title" => "Gagal", "text" => "Data gagal disimpan", "icon" => "error"];
            }
            session()->setFlashdata($response);
            return redirect()->back();
        }
    }

    public function reset_password()
    {
        $rules = [
            'password_new' => [
                'rules' => ['required', 'min_length[8]'],
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 8 karakter'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $id_user = $this->request->getPost('id_user');
        $password_old = $this->request->getPost('password_old');
        $password_new = $this->request->getPost('password_new');
        $get_data = $this->muser->find($id_user);
        if (password_verify($password_old, $get_data['password'])) {
            $data = [
                "id" => $id_user,
                "password" => password_hash($password_new, PASSWORD_DEFAULT)
            ];

            try {
                $this->muser->save($data);
                $response = ["title" => "Berhasil", "text" => "Password berhasil diganti", "icon" => "success"];
            } catch (\Throwable $th) {
                $response = ["title" => "Gagal", "text" => "Password gagal diganti", "icon" => "error"];
            }
        } else {
            $response = ["title" => "Gagal", "text" => "Password tidak sesuai", "icon" => "error"];
        }
        session()->setFlashdata($response);
        return redirect()->back();
    }


    // =======================================================================================
    // =================================Setting Guru==========================================
    // =======================================================================================
    protected function setting_guru()
    {
        $id_guru = session('id_guru');
        $agama = [
            "Islam",
            "Kristen",
            "Katolik",
            "Hindu",
            "Buddha",
            "Konghucu"
        ];
        $data = [
            "title" => "Setting",
            "data" => $this->mguru->get_guru($id_guru),
            "agama" => $agama
        ];
        $this->template->display('setting_guru', $data);
    }

    public function save_setting_guru()
    {
        $nuptk = $this->request->getPost('nuptk') ?? null;
        $nama = $this->request->getPost('nama');
        $jk = $this->request->getPost('jk');
        $tempat = $this->request->getPost('tempat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $alamat = $this->request->getPost('alamat') ?? null;
        $no_hp = $this->request->getPost('no_hp') ?? null;
        $email = $this->request->getPost('email');
        $agama = $this->request->getPost('agama');

        $id_guru = $this->request->getPost('id_guru');
        $id_user = $this->request->getPost('id_user');

        $data = [
            "id" => $id_guru,
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
            "email" => $email
        ];

        try {
            $this->mguru->save($data);
            $this->muser->save($data_user);

            $response = ["title" => "Berhasil", "text" => "Data berhasil diupdate", "icon" => "success"];
        } catch (\Throwable $th) {
            $response = ["title" => "Gagal", "text" => "Data gagal diupdate", "icon" => "error"];
        }

        session()->setFlashdata($response);
        return redirect()->back();
    }


    // =======================================================================================
    // =================================Setting Siswa=========================================
    // =======================================================================================
    protected function setting_siswa()
    {
        $id_siswa = session('id_siswa');
        $agama = [
            "Islam",
            "Kristen",
            "Katolik",
            "Hindu",
            "Buddha",
            "Konghucu"
        ];
        $data = [
            "title" => "Setting",
            "data" => $this->msiswa->get_siswa($id_siswa),
            "agama" => $agama
        ];
        // return $this->response->setJSON($data);
        $this->template->display('setting_siswa', $data);
    }

    public function save_setting_siswa()
    {
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
        $id_siswa = $this->request->getPost('id_siswa');
        $id_user = $this->request->getPost('id_user');

        $data = [
            "id" => $id_siswa,
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
        ];

        $data_user = [
            "id" => $id_user,
            "email" => $email
        ];

        try {
            $this->msiswa->save($data);
            $this->muser->save($data_user);
            $response = ["title" => "Berhasil", "text" => "Data berhasil diupdate", "icon" => "success"];
        } catch (\Throwable $th) {
            $response = ["title" => "Gagal", "text" => "Data gagal diupdate", "icon" => "error"];
        }

        session()->setFlashdata($response);
        return redirect()->back();
    }
}
