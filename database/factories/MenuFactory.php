<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 24/09/2017
 * Time: 1:11 PM
 */

use App\Entities\Menu;
use Faker\Generator;

$factory->define(Menu::class, function (Generator $faker) {
	$weeklySelection = [];
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        foreach ($days as $day) {
            $weeklySelection[$day]['lunch'] = [rand(1, 40),rand(1, 40)];
            $weeklySelection[$day]['dinner'] = [rand(1, 40),rand(1, 40)];
        }
    return $weeklySelection;
});