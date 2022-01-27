<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'status' => 'Open',
            'description' => 'U kunt zich nog inschrijven voor deze toerrit',
        ]);
        DB::table('statuses')->insert([
            'status' => 'Gesloten',
            'description' => 'U kunt zich niet meer inschrijven voor deze toerrit.',
        ]);
        DB::table('statuses')->insert([
            'status' => 'Geannuleerd',
            'description' => 'Deze toerrit is geannuleerd.',
        ]);
    }
}
