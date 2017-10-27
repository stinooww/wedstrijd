<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialFacebookAccount extends Model
{
    //
    protected $fillable = ['deelnemer_id', 'provider_user_id', 'provider'];

    public function deelnemer()
    {
        return $this->belongsTo('App\Deelnemer');
    }
}
