<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;
use App\User;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //True to make it a string
        'title' => $faker->words(5, true),
        'body' => $faker->text(3000),
        'published' => $faker->boolean,
        'user_id' => User::all()->random()->id
    ];
});
