<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create multiple users
        DB::table('users')->insert([
            [
                'name' => 'Isaque Soares',
                'email' => 'isaque@gmail.com',
                'password' => bcrypt('mudar123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Edaurda Salvador',
                'email' => 'eduarda@gmail.com',
                'password' => bcrypt('mudar123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Hosana Brasil',
                'email' => 'hosana@gmail.com',
                'password' => bcrypt('mudar123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Joao Batista',
                'email' => 'joao@gmail.com',
                'password' => bcrypt('mudar123'),
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
