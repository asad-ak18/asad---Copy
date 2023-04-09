<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class settingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                DB::table('web_s')->insert([
                'settings_name' => 'phone_number',
                'settings_value' => '01402567942',
              
                ]);
                DB::table('web_s')->insert([
                'settings_name' => 'email',
                'settings_value' => 'kasad5303@gmail.com',
              
                ]);
    }
}
