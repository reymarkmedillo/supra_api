<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'auth_type' => 'normal',
            'email' => 'client@email.com',
            'role' => 'user',
            'password' => app('hash')->make('1234'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'auth_type' => 'normal',
            'role' => 'admin',
            'email' => 'admin@email.com',
            'password' => app('hash')->make('1234'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
