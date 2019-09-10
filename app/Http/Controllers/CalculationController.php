<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CalculationController extends Controller
{
	//-- Overall amount of taxes collected per state --
    public function taxesCollectedPerState($country_id){

    	$country = Country::find($country_id);

    	$data = array();
    	$sum = 0;

    	foreach($country->states as $state){
    		$sum = 0;

    		foreach($state->counties as $county){
    			$sum += $county->taxes->sum('tax_collected');
    		}

    		$data[$state->id] = array(
    			'name' => $state->name,
    			'taxes_collected' => $sum
    		);
    	}

    	return $data;
    }

    //-- Average amount of taxes collected per state --
    public function averageCollectedTaxPerState($country_id){
    	
    	$country = Country::find($country_id);

    	$data = array();
    	$sum = 0;
    	$count = 0;

    	foreach($country->states as $state){
    		$sum = 0;
    		$count = 0;

    		foreach($state->counties as $county){
    			$sum += $county->taxes->sum('tax_collected');
    			$count++;
    		}

    		$data[$state->id] = array(
    			'name' => $state->name,
    			'average_collected_taxes' => round(($sum / $count),2)
    		);
    	}

    	return $data;
    }

    //-- Average county tax rate per state --
    public function averageCountyTaxRatePerState($country_id){
    	$country = Country::find($country_id);

    	$data = array();

    	foreach($country->states as $state){
    		$data[$state->id] = array(
    			'name' => $state->name,
    			'average_tax_rate' => round($state->counties->avg('tax_rate'),2)
    		);
    	}

    	return $data;
    }

    //-- Average tax rate of the country --
    public function avarageTaxRate($country_id){
    	$country = Country::find($country_id);

    	$sum = 0;
    	$count = 0;

    	foreach($country->states as $state){
    		foreach($state->counties as $county){
    			$sum += $county->tax_rate;
    			$count++;
    		}
    	}

    	return round(($sum / $count),2);
    }

    //-- Collected overall taxes of the country --
    public function overallCollectedTaxes($country_id){
        $country = Country::find($country_id);

        $data = 0;

        foreach($country->states as $state){
            foreach($state->counties as $county){
            	$data += $county->taxes->sum('tax_collected');
        	}
        }

        return $data;
    }

}
