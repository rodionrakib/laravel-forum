<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use App\Thread;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => function(){
            return factory(\App\User::class)->create()->id;
        },
        'thread_id' => function(){
        return factory(Thread::class)->create()->id;
        }
    ];
});
