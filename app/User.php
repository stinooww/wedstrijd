<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *user met extra atribuut role  zodat deze verantwoordelijke kunnen worden
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function wedstrijd()
    {
        return $this->hasMany('App\wedstrijd');
    }

    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }
}
