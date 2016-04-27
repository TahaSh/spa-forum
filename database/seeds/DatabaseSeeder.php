<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create(['name' => 'Foo', 'email' => 'foo@example.com']);
        $this->call(CategoriesTopicsSeeder::class);
    }
}
