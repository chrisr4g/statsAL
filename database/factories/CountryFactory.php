<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Country;
use Faker\Generator as Faker;

$factory->define(Countries::class, function (Faker $faker) {
    return [
       'name' => $faker->name;
    ];
});
