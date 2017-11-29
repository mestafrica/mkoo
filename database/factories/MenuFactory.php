<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 24/09/2017
 * Time: 1:11 PM
 */

use App\Entities\User;
use Faker\Generator;
use App\Entities\Menu;
use Carbon\Carbon;

/** @var $factory \Illuminate\Database\Eloquent\Factory */
$factory->define(Menu::class, function (Generator $faker) {

    return [
        'created_by' => factory(User::class)->create()->id,
        'serving_at' => new Carbon('this monday'),
    ];

});
