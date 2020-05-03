<?php

use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 10; $i++){
            $influencer = \App\User::find(rand(3,10));
            \App\Booking::create([
               'influencer_id' => $influencer->id,
                'full_name' => $faker->name,
                'occasion' => $faker->sentence,
                'instruction' => $faker->paragraph,
                'delivery_email' => $faker->email,
                'delivery_phone' => $faker->phoneNumber,
                'video_url' => 'backend/videos/default.mp4',
                'amount' => $influencer->rate,
            ]);
        }
    }
}
