<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'created_by'
    ];
}
