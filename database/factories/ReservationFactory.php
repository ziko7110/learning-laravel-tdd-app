<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use App\Models\Reservation;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'lesson_id' => null,
        'user_id' => null,
    ];
});
