<?php

use Faker\Generator as Faker;

$factory->define(App\Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->str_random(1).'-'.rand(100, 500)
    ];
});
