<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {

    return [
        'email_property' => $faker->unique()->safeEmail,
        'street' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'complement' => null,
        'neighborhood' => $faker->word,
        'city' => $faker->city,
        'state' => $faker->word,
        'status' => 'N',
    ];
});
