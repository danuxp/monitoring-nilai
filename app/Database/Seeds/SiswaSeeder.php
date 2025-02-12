<?php

namespace App\Database\Seeds;

use App\Models\MSiswa;
use CodeIgniter\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $msiswa = new MSiswa();
        $username = "181080200196";
        $siswa = [
            "nis" => $username,
            "nama" => strtoupper('danu pamungkas'),
            "jenis_kelamin" => "L",
            "agama" => "Islam",
            "tempat" => "Sidoarjo",
            "tgl_lahir" => "2005-10-14",
            "alamat" => "Kletek",
            "nama_ibu" => "Mega",
            "nama_ayah" => "Mulyono",
            "no_hp" => "085478996654"
        ];

        $user = [
            "username" => $username,
            "password" => password_hash($username, PASSWORD_DEFAULT),
            "role" => 3,
            "email" => $username . '@gmail.com'
        ];

        $msiswa->create_siswa($siswa, $user);
    }
}
