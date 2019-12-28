<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => function(){
            return factory(\App\User::class)->create();
        },
        'channel_id' => function(){
            return factory(\App\Channel::class)->create();
        },
    ];
});
