<?php
use App\Entities\Order;
use Carbon\Carbon;

$factory->define(Order::class, function () {
    $orderSelection['orders'] = [];
   
    $getDate = function ($day) {
        return  Carbon::now()->startOfWeek()->addWeek(1)
            ->addDay($day)->toDateString();
    };
    foreach (range(0, 5) as $day) {
        $choice[$getDate($day)]['lunch'] =  rand(1, 40);
        $choice[$getDate($day)]['dinner'] = rand(1, 40);
    }
    $orderSelection['orders'] = $choice;
    return $orderSelection;
});
