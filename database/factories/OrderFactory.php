<?php

use App\Entities\Menu;
use App\Entities\Order;

/** @var $factory \Illuminate\Database\Eloquent\Factory */
$factory->define(Order::class, function () {
    return [
        'menu_id' => factory(Menu::class)->create()->id
    ];
});
