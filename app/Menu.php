<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'created_by', 'serving_date'
    ];

    protected $dates = [
        'serving_date'
    ];
}
