<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contract;
use Faker\Generator as Faker;

$factory->define(Contract::class, function (Faker $faker) {
    return [
        'type_person' => 'F',
        'name' => $faker->name,
        'email_contract' => $faker->unique()->safeEmail,
        'property_id' => factory('App\Property')->create(),
        'document' => '01215125100',
        'uuid' => $faker->uuid,
    ];
});
