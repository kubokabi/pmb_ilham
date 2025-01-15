<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama'       => 'Admin',
            'email'      => 'admin@gmail.com',
            'password'   => password_hash('admin123', PASSWORD_BCRYPT),
            'role'       => 'admin',
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}