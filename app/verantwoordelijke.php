<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class verantwoordelijke extends Model
{
    //model heeft atributen: id,naam,ww,email,is_deleted,wedstrijd(fk)
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_deleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function wedstrijd()
    {
        return $this->belongsTo('App\wedstrijd');
    }
}
