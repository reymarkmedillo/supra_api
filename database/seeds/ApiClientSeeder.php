<?php

use Illuminate\Database\Seeder;

class ApiClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('api_clients')->insert([
            'name' => 'client_web',
            'type' => 'web',
            'secret' => str_random(28),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('api_clients')->insert([
            'name' => 'client_android',
            'type' => 'android',
            'secret' => str_random(28),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('api_clients')->insert([
            'name' => 'client_ios',
            'type' => 'ios',
            'secret' => str_random(28),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
