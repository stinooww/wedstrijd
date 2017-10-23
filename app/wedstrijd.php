<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wedstrijd extends Model
{
    //wedstrijd heeft attributen id,start en eind datum,naam,is_actief,wedstrijdeelnemer(fk),wedstrijdverantwoordelijke(fk)
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'start_date', 'end_date', 'is_active'
    ];

    public function user()
    {
        return $this->hasMany('app\User');
    }

    public function verantwoordelijke()
    {
        return $this->belongsTo('app\verantwoordelijke');
    }
}
