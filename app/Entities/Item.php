<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'created_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function meals()
    {
        return $this->belongsToMany(Meal::class)->withTimestamps();
    }

    /**
     * @param $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucwords($value);
    }
}
