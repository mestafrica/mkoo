<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 23/11/2017
 * Time: 7:45 PM
 */

namespace App\Exceptions;

class NoMealItemException extends \Exception
{
    public $message = 'You must provide at least 1 item to create a meal';
}
