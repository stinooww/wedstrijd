<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wedstrijd extends Model
{
    public $table = "wedstrijd";
    //wedstrijd heeft attributen id,start en eind datum,wedstrijdnaam,is_actief,,wedstrijdverantwoordelijke(fk)
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
        return $this->belongsTo('app\User');
    }


}
