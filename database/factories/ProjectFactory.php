<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => str_limit($faker->paragraph, 100),
        'notes' => 'Foobar notes',
        'owner_id' => factory(App\User::class)
    ];
});
