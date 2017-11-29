<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'created_by'
    ];

    protected $dates = [
        'serving_at'
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class)
            ->withPivot(['serves_at', 'type'])
            ->withTimestamps();
    }

}
