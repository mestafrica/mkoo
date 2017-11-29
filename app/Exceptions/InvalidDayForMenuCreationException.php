<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 28/11/2017
 * Time: 10:52 AM
 */

namespace App\Exceptions;


class InvalidDayForMenuCreationException extends \Exception
{

    public function __construct()
    {
        $days = config('mkoo.days_for_menu_creation');

        $this->message = sprintf('You can only create a menu on the following days: %s', implode(', ', $days));
    }
}