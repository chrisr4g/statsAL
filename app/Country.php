<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    
	public function states(){
		return $this->hasMany(States::class);
	}

}
