<?php

use Faker\Generator as Faker;

$factory->define(App\Todo::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'name' => $faker->sentence(3),
        'description' => $faker->text,
        'completed' => $faker->boolean
    ];
});
