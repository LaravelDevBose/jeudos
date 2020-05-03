<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 1; $i < 10; $i++){
            $booking = \App\Booking::find($i);
            \App\Review::create([
                'influencer_id' => $booking->influencer_id,
                'name' => $faker->name,
                'booking_id' => $i,
                'rating' => rand(1,5),
                'review' => $faker->paragraph,
            ]);
        }

    }
}
