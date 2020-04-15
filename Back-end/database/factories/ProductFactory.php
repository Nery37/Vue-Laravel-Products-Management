<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'license' => $faker->word,
        'support' => $faker->word,
        'technology' => $faker->word,
        'tickets' => $faker->randomDigitNotNull,
        'sales' => $faker->randomDigitNotNull,
        'earnings' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
