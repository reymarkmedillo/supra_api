<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // LEVEL 1
        DB::table('categories')->insert([
            'level' => 1,
            'name' => 'Theft',
            'parent_id' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('categories')->insert([
            'level' => 1,
            'parent_id' => '',
            'name' => 'Criminal Damage',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('categories')->insert([
            'level' => 1,
            'parent_id' => '',
            'name' => 'Assault',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        //LEVEL 2
        DB::table('categories')->insert([
            'level' => 2,
            'parent_id' => 1,
            'name' => 'Petty Theft',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('categories')->insert([
            'level' => 2,
            'parent_id' => 1,
            'name' => 'Robbery',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        // --
        DB::table('categories')->insert([
            'level' => 2,
            'parent_id' => 2,
            'name' => 'Intent and Recklessness',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('categories')->insert([
            'level' => 2,
            'parent_id' => 2,
            'name' => 'Belonging to Another',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        // --
        DB::table('categories')->insert([
            'level' => 2,
            'parent_id' => 3,
            'name' => 'Aggravated Assault',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('categories')->insert([
            'level' => 2,
            'parent_id' => 3,
            'name' => 'Sexual Assault',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        // LEVEL 3
        DB::table('categories')->insert([
            'level' => 3,
            'parent_id' => 5,
            'name' => 'Armed Robbery',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('categories')->insert([
            'level' => 3,
            'parent_id' => 5,
            'name' => 'Carjacking',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        // --
        DB::table('categories')->insert([
            'level' => 3,
            'parent_id' => 9,
            'name' => 'Stalking',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('categories')->insert([
            'level' => 3,
            'parent_id' => 9,
            'name' => 'Sexual Harassment',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}