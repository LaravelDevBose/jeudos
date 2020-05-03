<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Wallet;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $admin = User::create([
            'name' => 'Jeudos Admin',
            'email' => 'admin@jeudos.com',
            'password' => Hash::make('admin'),
             'email_verified_at' => date('Y-m-d H:i:s')
        ]);
        $admin->assignRole('admin');
        Wallet::create([
            'user_id' => $admin->id,
        ]);

        $influencer = User::create([
            'name' => 'Jeudos Influencer',
            'title' => 'Frodo/ Lord of the rings',
            'description' => $faker->paragraph,
            'profile_image_url' => $faker->imageUrl(),
            'category_id' => rand(1,10),
            'sub_category_id' => rand(1,30),
            'rate' => rand(1,200),
            'tags' => $faker->word.','.$faker->word.','.$faker->word.','.$faker->word,
            'email' => 'influencer@jeudos.com',
            'password' => Hash::make('influencer'),
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);
        $influencer->assignRole('influencer');
        Wallet::create([
            'user_id' => $influencer->id,
        ]);

        $fan = User::create([
            'name' => 'Jeudos fan',
            'email' => 'fan@jeudos.com',
            'password' => Hash::make('fan'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
        $fan->assignRole('fan');
        Wallet::create([
            'user_id' => $fan->id,
        ]);

        for($i = 0; $i < 30; $i++){
            $email = $faker->email;
            $influencer = User::create([
                'name' => $faker->name,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'profile_image_url' => $faker->imageUrl(),
                'category_id' => rand(1,5),
                'sub_category_id' => rand(1,30),
                'rate' => rand(1,200),
                'tags' => $faker->word.','.$faker->word.','.$faker->word.','.$faker->word,
                'email' => $email,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make(explode(',',$email)[0])
            ]);
            $influencer->assignRole('influencer');
            Wallet::create([
                'user_id' => $influencer->id,
            ]);
        }
    }
}
