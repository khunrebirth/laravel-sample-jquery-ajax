<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'price' => $faker->numberBetween(1000, 9000)
    ];
});
