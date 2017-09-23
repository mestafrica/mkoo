<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 23/09/2017
 * Time: 5:29 PM
 */

use App\Meal;
use Faker\Generator;

$factory->define(Meal::class, function (Generator $faker) {

    return [
        'name' => $faker->sentence(),
        'description' => $faker->text
    ];
});