<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deelnemer extends Model
{
    //dit model defenieert de wedstrijdeelnemer, attributen zijn: id, voornaam, achternaam, straat, nummer,gemeente,disqualified, is_deleted email, ip,wedstrijdvraag

    protected $fillable = [
        'firstname', 'lastname', 'email', 'street', 'streetnumber', 'postcode', 'disqualified', 'is_deleted', 'question'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'ip'
    ];

    public function winnaar()
    {
        return $this->belongsTo('App\winnaar');
    }

    public function wedstrijd()
    {
        return $this->belongsTo('App\wedstrijd');
    }
}
