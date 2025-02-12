<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('GuruSeeder');
        $this->call('SiswaSeeder');
    }
}
