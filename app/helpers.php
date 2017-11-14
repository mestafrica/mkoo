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



function isValidCred($params, $auth_type)
{
    
    $validStatements = [
        "signup"=>   [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ],
        "login"=>  [
            'email' => 'required|email',
            'password' => 'required',
        ],


    ];
    $validator = \Validator::make($params, $validStatements[$auth_type]);
    return   ( $validator->fails() )? $validator->messages() : false ;
}
