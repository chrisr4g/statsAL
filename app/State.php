<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function counties(){
    	return $this->hasMany(County::class);
    }

    public function country(){
    	return $this->belongsTo(Country::class);
    }
}
