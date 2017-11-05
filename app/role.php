<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    public $table = "role";
    protected $fillable = ['role'];

    //
    public function user()
    {
        return $this->belongsTo('app\User');
    }
}
