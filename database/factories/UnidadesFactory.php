<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Unidad;
use Faker\Generator as Faker;

$factory->define(Unidad::class, function (Faker $faker) {
    $nombre = $faker->word;
    $abreviatura = $faker->suffix;
    return [
        'nombre'  => $nombre,
        'abreviatura'  => $abreviatura,
    ];
});
