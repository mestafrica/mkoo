<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name'
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
