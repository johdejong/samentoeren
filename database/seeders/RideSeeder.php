<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rides')->insert([
            'name' => 'Toer 1',
            'description' => 'Dit is de omschrijving die bij Toer 1 hoort.',
            'type_id' => '1',
            'status_id' => '1',
            'start_date' => '2021-12-01',
            'start_time' => '09:00:00',
            'start_location_id' => '1',
            'finish_date' => '2021-12-01',
            'finish_time' => '12:00:00',
            'finish_location_id' => '2',
            'distance' => '200',
        ]);
        DB::table('rides')->insert([
            'name' => 'Toer 2',
            'description' => 'Dit is de omschrijving die bij Toer 2 hoort.',
            'type_id' => '2',
            'status_id' => '2',
            'start_date' => '2022-01-01',
            'start_time' => '13:00:00',
            'start_location_id' => '2',
            'finish_date' => '2022-01-01',
            'finish_time' => '17:00:00',
            'finish_location_id' => '2',
            'distance' => '150',
        ]);
        DB::table('rides')->insert([
            'name' => 'Toer 3',
            'description' => 'Dit is de omschrijving die bij Toer 3 hoort.',
            'type_id' => '3',
            'status_id' => '3',
            'start_date' => '2022-02-01',
            'start_time' => '19:00:00',
            'start_location_id' => '3',
            'finish_date' => '2022-02-01',
            'finish_time' => '23:00:00',
            'finish_location_id' => '1',
            'distance' => '125',
        ]);
    }
}
