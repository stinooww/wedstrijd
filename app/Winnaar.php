<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class winnaar extends Model
{
    //winnaar heefta als attributen: id,gekwalificeerd,,wedstrijddeelnemer fk, wedstrijd fk
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'disqualified',
    ];

    public function Users()
    {
        return $this->belongsTo('App\Deelnemer');
    }

    public function wedstrijd()
    {
        return $this->belongsTo('App\wedstrijd');
    }
}