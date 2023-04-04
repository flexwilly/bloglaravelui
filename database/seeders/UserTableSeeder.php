<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //prevent foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //reset the table
        DB::table('users')->truncate();

        //generate 3 users
        DB::table('users')->insert([
            [
                'name'=> 'John Doe',
                'email' => 'johndoe@test.com',
                'password'=> bcrypt('secret'),
            ],
            [
                'name'=> 'Jane Doe',
                'email' => 'janedoe@test.com',
                'password'=> bcrypt('secret'),
            ],
            [
            'name'=> 'Edo Masaru',
                'email' => 'edo@test.com',
                'password'=> bcrypt('secret'),
            ]
        ]);
    }
}
