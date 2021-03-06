<?php

use Illuminate\Database\Seeder;
use App\Bulong\Categories\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 8)->create();
    }
}
