<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ApiClientSeeder::class);
        $this->call(CaseTableSeeder::class);
        $this->call(CaseGroupSeeder::class);
        $this->call(AccessTokenSeeder::class);
        $this->call(UserHighlightSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserProfileSeeder::class);
    }
}
