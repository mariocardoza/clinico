<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Unidad;
use Faker\Generator as Faker;

$factory->define(Unidad::class, function (Faker $faker) {
    $nombre = $faker->word;
    return [
        'nombre'  => $nombre,
    ];
});
