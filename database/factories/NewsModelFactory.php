<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bulong\News\News;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(News::class, function (Faker $faker) {
    $file = UploadedFile::fake()->image('news.png', 600, 600);

    $title = $faker->sentence;
    $slug = str_slug($title, '-');

    return [
        'title' => $title,
        'slug' => $slug,
        'description' => $faker->paragraph,
        'image' => $file->store('news', ['disk' => 'public']),
    ];
});
