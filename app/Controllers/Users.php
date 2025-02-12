<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MUsers;

class Users extends BaseController
{
    protected $musers;
    public function __construct()
    {
        $this->musers = new MUsers();
    }
    public function index()
    {
        $admin = $this->musers->get_role_users(1);
        $guru = $this->musers->get_role_users(2);
        $siswa = $this->musers->get_role_users(3);
        $data = [
            "title" => "Data Users",
            "admin" => $admin,
            "guru" => $guru,
            "siswa" => $siswa
        ];
        $this->template->display('users/index', $data);
    }
}
