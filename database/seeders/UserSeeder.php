<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'Usuario de Prueba',
            'email'=> 'user@gmail.com',
            'password'=> bcrypt('123456')
        ]);
        User::factory(9)->create();
    }
}
