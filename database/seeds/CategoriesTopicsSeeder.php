<?php

use App\Topic;
use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::truncate();
        Category::truncate();

        factory(Category::class, 5)->create()->each(function($c) {
            $c->topics()->saveMany(
                factory(Topic::class, 5)->create([
                    'category_id' => $c->id
                ])
            );
        });
    }
}

