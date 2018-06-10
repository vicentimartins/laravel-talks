<?php

use App\Talk;
use App\User;
use Faker\Generator as Faker;

$factory->define(Talk::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'title' => $faker->title(),
        'description' => $faker->paragraph(),
        'slides_url' => $faker->url,
        'video_url' => $faker->url,
        'thumbnail_path' => 'storage/thumbnails/image.jpg',
        'available_to_speak' => false,
    ];
});
