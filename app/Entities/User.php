<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

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
        'gender', 'last_login', 'password'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Hashes password (if necessary) before saving to database
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password)) {
            $this->attributes['password'] = bcrypt($password);
        } else {
            $this->attributes['password'] = $password;
        }
    }

    public function getFullName()
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function userable()
    {
        return $this->morphTo();
    }

    public function isEit()
    {
        return $this->userable instanceof EIT;
    }

    public function isStaff()
    {
        return $this->userable instanceof Staff;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|Order|null|static
     */
    public function getCurrentWeekOrder()
    {
        return $this->orders()->whereBetween('created_at', [
            Carbon::today()->copy()->startOfWeek(), Carbon::today()
        ])->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|Order|null|static
     */
    public function getNextWeekOrder()
    {
        $nextWeek = Carbon::today()->addWeek();

        return $this->orders()->whereBetween('created_at', [
            $nextWeek->copy()->startOfWeek(), $nextWeek->copy()->endOfWeek()
        ])->first();
    }

}
