<?php

/*
|--------------------------------------------------------------------------
| Resource Factory
|--------------------------------------------------------------------------
|
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Resource::class, function (Faker\Generator $faker) {

    return [
        'street'       => $faker->streetName(),
        'number'       => $faker->numberBetween(10, 5000),
        'complement'   => $faker->sentence(1),
        'zip_code'     => $faker->randomNumber(),
        'neighborhood' => $faker->sentence(1),
        'city'         => $faker->sentence(1),
        'state'        => $faker->stateAbbr(),
        'latitude'     => $faker->latitude(),
        'longitude'    => $faker->longitude(),
    ];

});

$factory->state(App\Models\Resource::class, 'user', function (Faker\Generator $faker) {

    return [
        'user_id' => function (array $address) {
            return factory(App\Models\User::class)->create()->id;
        },
    ];

});
