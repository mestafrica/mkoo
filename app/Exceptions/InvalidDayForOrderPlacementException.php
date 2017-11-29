<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 28/11/2017
 * Time: 10:52 AM
 */

namespace App\Exceptions;


class InvalidDayForOrderPlacementException extends \Exception
{

    public function __construct()
    {
        $days = config('mkoo.days_for_order_placement');

        $this->message = sprintf('You can only place an order on the following days: %s', implode(', ', $days));
    }
}