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
        for ($i=15; $i < 35; $i++) {

            \App\Models\User::insert([
                'name_id'   => '00 '.$i,
                'nick_name'    => 'admin '.$i,
                'user_type'   => rand(1,3),
                'email'    => 'email@ '.$i.'com',
                'status'   => rand(1,3),

            ]);
        }
    }
}
