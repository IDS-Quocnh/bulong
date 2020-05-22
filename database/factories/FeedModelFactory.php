<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bulong\Feeds\Feed;
use App\Bulong\Users\User;
use Faker\Generator as Faker;
use App\Bulong\Categories\Category;

$factory->define(Feed::class, function (Faker $faker) {
    $user = factory(User::class)->create();
    $category = factory(Category::class)->create();

    return [
        'text' => $faker->sentence,
        'user_id' => $user->fresh()->id,
        'category_id' => $category->fresh()->id,
    ];
});
