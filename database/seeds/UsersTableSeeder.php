<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('admins')->insert([
            'name'	        => 'admin',
            'email'			=> 'admin@admin.com',
            'status'        => '1',
            'password'		=> bcrypt('43lw9rj2'),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ]);
    }
}
