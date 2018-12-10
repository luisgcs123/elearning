<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['PHP','JAVASCRIPT','DISEÑO WEB','SERVIDORES','MYSQL']),
        'description' => $faker->sentence
    ];
});
