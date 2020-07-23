<?php

use App\TeachersPlans;
use Illuminate\Database\Seeder;

class TeachersPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeachersPlans::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i< 25; $i++){
            TeachersPlans::create([
                'title' => $faker->sentence,
                'problem' => $faker->paragraph,
                'solution'=> $faker->paragraph
            ]);
        }
    }
}