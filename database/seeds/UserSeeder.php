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
        // DB::table('users')->insert([
        //     'auth_type' => 'google_oauth',
        //     'email' => 'juandelacruz@gmail.com',
        //     'password' => app('hash')->make('my-password'),
        //     'created_at' => \Carbon\Carbon::now(),
        //     'updated_at' => \Carbon\Carbon::now()
        // ]);
        DB::table('users')->insert([
            'auth_type' => 'normal',
            'email' => 'admin@email.com',
            'password' => app('hash')->make('1234'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
