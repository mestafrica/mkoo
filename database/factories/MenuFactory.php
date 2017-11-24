<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 24/09/2017
 * Time: 1:11 PM
 */

use Faker\Generator;
use App\Entities\Menu;
use Carbon\Carbon;

$factory->define(Menu::class, function (Generator $faker) {
    $weeklySelection['meals'] = [];
   
    $getDate = function ($day) {
        return  Carbon::now()->startOfWeek()->addWeek(1)
            ->addDay($day)->toDateString();
    };
    foreach (range(0, 5) as $day) {
        $weeklySelection[$getDate($day)]['lunch'] = [rand(1, 40),rand(1, 40)];
        $weeklySelection[$getDate($day)]['dinner'] = [rand(1, 40),rand(1, 40)];
    }
    return $weeklySelection;
});
