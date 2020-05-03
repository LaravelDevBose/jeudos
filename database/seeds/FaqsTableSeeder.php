<?php

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 6; $i++){
            \App\Faq::create([
                'question' => $faker->sentence,
                'answer' => $faker->paragraph
            ]);
        }
    }
}
