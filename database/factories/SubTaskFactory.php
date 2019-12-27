<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SubTask;
use Faker\Generator as Faker;

$factory->define(SubTask::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'description' => $faker->text(250),
        'task_id' => $faker->numberBetween($min = 1, $max = 60),
    ];
});
