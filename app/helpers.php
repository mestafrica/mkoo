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
