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

    public function taxesCollected(){
    	return $this->counties->taxes->sum('tax_collected');
    }

    public function avgTaxesCollected(){
    	return $this->counties->taxes->avg('tax_collected');
    }

    public function avgTaxRate(){
    	return $this->counties->avg('tax_rate');
    }
}
