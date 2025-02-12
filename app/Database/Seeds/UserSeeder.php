<?php

namespace App\Database\Seeds;

use App\Models\MUsers;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = new MUsers();
        $user = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'email' => 'admin@gmail.com',
            'role' => 1
        ];

        $users->save($user);
    }
}
