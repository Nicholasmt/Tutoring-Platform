<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('super_admins')->insert(['role_id'=>1,'first_name'=>'super','last_name'=>'admin','email'=>'admin@gmail.com','password'=>\Hash::make('12345678')]);
    }
}
