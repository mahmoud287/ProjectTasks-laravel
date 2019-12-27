<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'description' => $faker->text(250),
        'project_id' => $faker->numberBetween($min = 1, $max = 30),
    ];
});
