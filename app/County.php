<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    public function taxes(){
    	return $this->hasMany(Tax::class);
    }

    public function state(){
    	return $this->belongsTo(State::class);
    }
}
