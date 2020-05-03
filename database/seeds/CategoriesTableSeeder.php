<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\SubCategory;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        Category::create([
            'name' => "Default",
            'image_url' => $faker->imageUrl(),
            'color' => $faker->hexColor
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name' => 'Default'
        ]);
        for($i = 0; $i < 30; $i++){
            $category = Category::create([
                'name' => $faker->word,
                'image_url' => $faker->imageUrl(),
                'color' => $faker->hexColor
            ]);
            SubCategory::create([
                'category_id' => $category->id,
                'name' => $faker->word
            ]);
            SubCategory::create([
                'category_id' => $category->id,
                'name' => $faker->word
            ]);
            SubCategory::create([
                'category_id' => $category->id,
                'name' => $faker->word
            ]);
        }

    }
}
