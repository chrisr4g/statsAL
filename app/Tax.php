<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    public function county(){
    	return $this->belongsTo(County::class);
    }
}
