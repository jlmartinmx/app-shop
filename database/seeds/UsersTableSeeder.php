<?php

use Illuminate\Database\Seeder;
use App\User;

// 22 0:0
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Jose Martinez',
            'username'  =>  'jose',
            'email'     => 'jlmartin_mx@hotmail.com',
            'password'  =>  bcrypt('notiene123'),
            'admin'     =>  true,
            'phone'     =>  '1234567890',
            'address'   =>  'conocida'
        ]);

        User::create([
            'name'      =>  'Carlos Montemayor',
            'username'  =>  'carlos',
            'email'     =>  'carlos@hotmail.com',
            'password'  =>  bcrypt('notiene123'),
            'admin'     =>  false,
            'phone'     =>  '0987654321',
            'address'   =>  'desconocida'
        ]);
    }
}
