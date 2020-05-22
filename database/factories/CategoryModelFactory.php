<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bulong\Categories\Category;
use Illuminate\Http\UploadedFile;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $file = UploadedFile::fake()->image('category.png', 600, 600);

    return [
        'name' => $faker->name,
        'image' => $file->store('categories', ['disk' => 'public']),
        'slug' => $faker->slug,
    ];
});
