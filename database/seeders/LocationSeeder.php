<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'name' => 'Thuisbasis',
            'description' => 'Thuis bij Johan en Jolanda',
            'address' => 'Delling 15',
            'postal_code' => '8401 MX',
            'residence' => 'Gorredijk',
            'country_id' => '1',
        ]);
        DB::table('locations')->insert([
            'name' => 'Koepelbos',
            'description' => 'Restaurant ´t Koepelbos',
            'address' => 'Stellingenweg 1',
            'postal_code' => '8421 DA',
            'residence' => 'Oldeberkoop',
            'country_id' => '1',
        ]);
        DB::table('locations')->insert([
            'name' => 'McDonalds Azeven Drachten',
            'description' => 'McDonalds Azeven Drachten',
            'address' => 'Bohrlaan 10',
            'postal_code' => '9207 HA',
            'residence' => 'Drachten',
            'country_id' => '1',
        ]);
    }
}
