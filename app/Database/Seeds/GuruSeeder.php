<?php

namespace App\Database\Seeds;

use App\Models\MGuru;
use CodeIgniter\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $mguru = new MGuru();
        $guru = [
            "nuptk" => "123456",
            "nama" => strtoupper('beny pramono'),
            "jenis_kelamin" => "L",
            "agama" => "Islam",
            "tempat" => "Sidoarjo",
            "tgl_lahir" => "1985-01-14",
            "alamat" => "Sidoarjo",
            "no_hp" => "085478991234",
            "agama" => "Islam"
        ];

        $user = [
            "username" => "Beny",
            "password" => password_hash('guru123', PASSWORD_DEFAULT),
            "role" => 2,
            "email" =>  'guru@gmail.com'
        ];

        $mguru->create_guru($guru, $user);
    }
}
