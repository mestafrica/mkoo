<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id', 'serves_at', 'meal_id','type'
    ];

    protected $dates = [
        'serving_at'
    ];

    // protected $table = 'menu_items';

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'option_id', 'menu_id');
    }
}
