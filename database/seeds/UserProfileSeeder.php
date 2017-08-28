<?php

use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profile')->insert([
            'user_id' => 1,
            'first_name' => 'Juan',
            'last_name' => 'De la Cruz',
            'address' => "1600 Amphitheatre Parkway, Mountain View, CA, USA",
            'premium' => true,
            'payment_method' => 'paypal',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
