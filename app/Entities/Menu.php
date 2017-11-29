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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function meals()
    {
        return $this->belongsToMany(Meal::class)
            ->withPivot(['serves_at', 'type'])
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get meals in this menu that are supposed to be served as dinner
     *
     * @param $date
     * @return mixed
     */
    public function dinner($date)
    {
        return $this->meals()
            ->wherePivot('type', 'dinner')
            ->wherePivot('serves_at', $date)
            ->get();
    }

    /**
     * Get meals in this menu that are supposed to be served as lunch
     *
     * @param $date
     * @return mixed
     */
    public function lunch($date)
    {
        return $this->meals()
            ->wherePivot('type', 'lunch')
            ->wherePivot('serves_at', $date)
            ->get();
    }

}
