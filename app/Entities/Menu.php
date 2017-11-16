<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'created_by', 'serving_at'
    ];

    protected $dates = [
        'serving_at'
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'menu_items', 'menu_id', 'meal_id');
    }
}
