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


function mkoo_flash($message, $message_color = '#736F6F')
{
    $custom_colors =
    [
       'error' => '#EA7878',
       'warning' => '#F1D97A',
       'success' => '#7BE454',
       'notification' => '#736F6F',
    ];
       (isset($custom_colors[$message_color])) ? $notification_color =
       $custom_colors[$message_color]
       : $notification_color = $message_color;

       Session::flash('flash_color', $notification_color);
       Session::flash('flash_message', $message);
}
