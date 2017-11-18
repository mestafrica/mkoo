<?php

use App\Entities\MenuItem;
use Faker\Generator;

$factory->define(MenuItem::class, function (Generator $faker) {
	$menuItems = [];
	$days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

		foreach ($days as $day) {
			$menuItems[$day]['lunch'] = [rand(1, 40),rand(1, 40)]; 
			$menuItems[$day]['dinner'] = [rand(1, 40),rand(1, 40)];
		}
		return $menuItems;
	});