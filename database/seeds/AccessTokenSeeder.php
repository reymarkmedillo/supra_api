<?php

use Illuminate\Database\Seeder;

class AccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_tokens')->insert([
            'user_id' => 1,
            'api_token' => str_random(28),
            'api_client_id' => 1,
            'expires_at' => \Carbon\Carbon::now(),
            'refresh_token' => str_random(28),
            'refresh_expires_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
