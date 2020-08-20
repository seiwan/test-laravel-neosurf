<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'category' => $faker->word,
        'supplier' => $faker->company,
        'description' => $faker->text(200),
        'price' => $faker->randomFloat(2, 0, 100000),
        'quantity' => $faker->numberBetween(0, 100000)
    ];
});
