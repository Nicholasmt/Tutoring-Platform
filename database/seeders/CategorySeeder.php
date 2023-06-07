<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['title'=>'EYFS']);
        DB::table('categories')->insert(['title'=>'Primary School']);
        DB::table('categories')->insert(['title'=>'Junior School']);
        DB::table('categories')->insert(['title'=>'Senior School']);
        DB::table('categories')->insert(['title'=>'Senior School']);
        DB::table('categories')->insert(['title'=>'External exams']);
    }
}
