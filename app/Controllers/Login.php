<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MUsers;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        return view('login', ['title' => 'Login']);
    }

    public function validasi()
    {
        $m_users = new MUsers();

        $username = $this->request->getPost('username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $this->request->getPost('password');

        $data = [
            'username' => $username,
            'password' => $password
        ];

        $rules = [
            'username' => [
                'rules' => ['required'],
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong'
                ]
            ]
        ];

        if (strpos($username, '@') !== false) {
            $rules['username']['rules'][] = 'valid_email';
            $rules['username']['errors']['valid_email'] = 'Email tidak valid';
        }


        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        $check_data = $m_users->get_user($username);

        if ($check_data) {
            $pass = $check_data['password'];
            $verify = password_verify($password, $pass);

            $role = $check_data['role'];

            if ($verify) {
                $sesi = [
                    'user_id' => $check_data['id_user'],
                    'role' => $role,
                    'isLogged' => true
                ];

                if ($role == 1) {
                    $sesi['nama'] = strtoupper($check_data['username']);
                    $redirect = 'admin';
                } else if ($role == 2) {
                    $sesi['nama'] = strtoupper($check_data['nama_guru']);
                    $sesi['id_guru'] = $check_data['id_guru'];
                    $redirect = 'guru';
                } else {
                    $sesi['nama'] = strtoupper($check_data['nama_siswa']);
                    $sesi['id_siswa'] = $check_data['id_siswa'];
                    $redirect = 'siswa';
                }

                session()->set($sesi);
                return redirect()->to('dashboard-' . $redirect);
            } else {
                session()->setFlashdata(['pesan' => 'Email / Password Salah']);
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata(['pesan' => 'Data tidak ditemukan!']);
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
