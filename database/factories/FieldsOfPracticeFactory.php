<?php

use App\FieldsOfPractice;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(FieldsOfPractice::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company
    ];
});
