<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'userable_type', 'userable_id', 'google_id', 'avatar',
        'gender', 'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'last_login',
    ];

    public function getFullName()
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    public function getFirstName()
    {
        return $this->first_name;
    }
}
