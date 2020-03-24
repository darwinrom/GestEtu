<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Persons;
use Faker\Generator as Faker;

$factory->define(Persons::class, function (Faker $faker) {
    return [
        'address'=> $faker->address,
        'streetName'=> $faker->streetAddress,
        'state'=> $faker->state,
        'phoneNumber'=> $faker->phoneNumber,
    ];
});

