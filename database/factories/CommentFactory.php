<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        // 'message' => $faker->text(10),
        // 'user_id' => User::all()->random()->id,
        // 'parent_id' => Comment::all()->random()->id    
    ];
});
