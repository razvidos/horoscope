<?php

namespace Database\Seeders;

use App\Models\Prediction;
use Illuminate\Database\Seeder;

class PredictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prediction::factory(300)->create();
    }
}
