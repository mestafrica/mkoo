<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EIT extends Model
{
    protected $fillable = [
        'country',  'class', 'cohort'
    ];

    public function getMorphClass()
    {
        return self::class;
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
