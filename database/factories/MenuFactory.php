<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 24/09/2017
 * Time: 1:11 PM
 */

use App\Menu;
use Faker\Generator;

$factory->define(Menu::class, function (Generator $faker) {

    return [
        'serving_date' => $faker->date()
    ];
});