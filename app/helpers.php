<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 24/09/2017
 * Time: 12:10 AM
 */


if (! function_exists('is_active_route')) {
    function is_active_route($routePrefix)
    {
        if (strpos(request()->route()->getName(), $routePrefix) !== false) {
            return 'class = active';
        }
    }
}

if (! function_exists('getDatesForTheWeek')) {
    function getDatesForTheWeek()
    {
        $startDate = \Carbon\Carbon::now()->addWeek()->startOfWeek();

        return collect(range(0, 5))
            ->map(function ($day) use ($startDate) {
                return $startDate->copy()->addDay($day)->toDateString();
            })
            ->toArray();
    }
}
