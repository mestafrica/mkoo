<?php

use App\Entities\Item;
use App\Entities\User;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'created_by' => factory(User::class)->create()->id,
    ];
});
