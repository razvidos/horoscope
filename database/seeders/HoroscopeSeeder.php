<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoroscopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('horoscopes')->insert([
            ['title' => 'Aries'],
            ['title' => 'Taurus'],
            ['title' => 'Gemini'],
            ['title' => 'Cancer'],
            ['title' => 'Leo'],
            ['title' => 'Virgo'],
            ['title' => 'Libra'],
            ['title' => 'Scorpio'],
            ['title' => 'Sagittarius'],
            ['title' => 'Capricorn'],
            ['title' => 'Aquarius'],
            ['title' => 'Pisces'],
        ]);
    }
}
