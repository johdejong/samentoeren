<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'type' => 'Ochtend',
            'description' => 'Deze rit vindt plaats tussen 00:00 en 12:00 uur',
        ]);
        DB::table('types')->insert([
            'type' => 'Middag',
            'description' => 'Deze rit vindt plaats tussen 12:00 en 18:00 uur.',
        ]);
        DB::table('types')->insert([
            'type' => 'Avond',
            'description' => 'Deze rit vindt plaats tussen 18:00 en 23:59 uur',
        ]);
    }
}
