<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['title'=>'Admin','privilege'=>1]);
        DB::table('roles')->insert(['title'=>'Teacher','privilege'=>2]);
        DB::table('roles')->insert(['title'=>'Parent','privilege'=>3]);
    }
}
