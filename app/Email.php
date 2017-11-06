<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    //public $table = "email";
    //
    protected $fillable = [
        'user_id',
        'wedstrijd_id',
    ];

    public function user()
    {
        return $this->belongsTo('app\User');
    }

    public function wedstrijd()
    {
        return $this->belongsTo('app\Wedstrijd');
    }
}
