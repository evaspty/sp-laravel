<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; //panggil model user
use Illuminate\Support\Facades\Hash; //panggil library untuk hash password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //masukan data name, email, password ke tabel user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
         ]);
    }
}
