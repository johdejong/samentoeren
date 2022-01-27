<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DistancecategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('distancecategories')->insert([
            'distancecategory' => '0 tot 50 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => '51 tot 100 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => '101 tot 151 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => '151 tot 200 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => '201 tot 250 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => '251 tot 300 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => '301 tot 350 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => '351 tot 400 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => '401 tot 450 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => '451 tot 500 km',
        ]);
        DB::table('distancecategories')->insert([
            'distancecategory' => 'meer dan 500 km',
        ]);
    }
}
