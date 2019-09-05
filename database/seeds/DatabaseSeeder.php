<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    //    DB::table('users')->insert([
    //     'name' => 'jonathan',
    //     'email' => 'admin@hotmail.com',
    //     'password' => bcrypt('123'),
    // ]);

       DB::table('users')->insert([
        'name' => 'Marc',
        'email' => 'marc@testing.com',
        'password' => bcrypt('Success2020'),
        'profile_default' => '3404676718875321',
    ]);

      
   }
}
