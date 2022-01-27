<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Johan de Jong',
            'email' => 'johan@johanenjolanda.nl',
            'password' => Hash::make('29101965'),
            'admin' => '1',
            'active' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'Jolanda Joustra',
            'email' => 'jolanda@johanenjolanda.nl',
            'password' => Hash::make('29101965'),
            'admin' => '1',
            'active' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'Marijn de Jong',
            'email' => 'marijn@johanenjolanda.nl',
            'password' => Hash::make('29101965'),
            'admin' => '0',
            'active' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'Kilian de Jong',
            'email' => 'kilian@johanenjolanda.nl',
            'password' => Hash::make('29101965'),
            'admin' => '0',
            'active' => '0',
        ]);
    }
}
