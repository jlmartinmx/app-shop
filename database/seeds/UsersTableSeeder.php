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
            'name'      => 'Jose',
            'email'     => 'jlmartin_mx@hotmail.com',
            'password'  =>  bcrypt('notiene123'),
            'admin'     =>  true
        ]);

        User::create([
            'name'      => 'carlos',
            'email'     => 'carlos@hotmail.com',
            'password'  => bcrypt('notiene123'),
            'admin'     => false
        ]);
    }
}
