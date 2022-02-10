<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'code' => 'NL',
            'name' => 'Nederland',
        ]);
        DB::table('countries')->insert([
            'code' => 'DE',
            'name' => 'Duitsland',
        ]);
        DB::table('countries')->insert([
            'code' => 'BE',
            'name' => 'Belgie',
        ]);
        DB::table('countries')->insert([
            'code' => 'DK',
            'name' => 'Denemarken',
        ]);
        DB::table('countries')->insert([
            'code' => 'LU',
            'name' => 'Luxemburg',
        ]);
    }
}
