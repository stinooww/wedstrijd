<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class winnaar extends Model
{
    public $table = "winnaar";
    //winnaar heefta als attributen: id,gekwalificeerd,,wedstrijddeelnemer fk, wedstrijd fk
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'disqualified',
    ];

    public function deelnemer()
    {
        return $this->belongsTo('App\Deelnemer');
    }

    public function wedstrijd()
    {
        return $this->belongsTo('App\wedstrijd');
    }
}
