<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\CalculationController;
use App\Country;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->Calculation = new CalculationController;
        $this->Country = new Country;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dashboardData['country'] = $this->Country->first(); // Country type object
        
        /**
         *  array( 
         *      array('name' => 'name of the state', 'taxes_collected' => 'number with 2 decimals'), 
         *      array('name' => 'name of the 2nd state', 'taxes_collected' => 'number with 2 decimals')
         *      ...
         *  )
         */
        $dashboardData['taxes']['taxesCollectedPerState'] = $this->Calculation->taxesCollectedPerState($dashboardData['country']->id);

        /**
         *  array( 
         *      array('name' => 'name of the state', 'average_collected_taxes' => 'number with 2 decimals'), 
         *      array('name' => 'name of the 2nd state', 'average_collected_taxes' => 'number with 2 decimals')
         *      ...
         *  )
         */
        $dashboardData['taxes']['averageCollectedTaxPerState'] = $this->Calculation->averageCollectedTaxPerState($dashboardData['country']->id);

        /**
         *  array( 
         *      array('name' => 'name of the state', 'average_tax_rate' => 'number with 2 decimals'), 
         *      array('name' => 'name of the 2nd state', 'average_tax_rate' => 'number with 2 decimals')
         *      ...
         *  )
         */
        $dashboardData['taxes']['averageCountyTaxRatePerState'] = $this->Calculation->averageCountyTaxRatePerState($dashboardData['country']->id);

        $dashboardData['taxes']['avarageTaxRate'] = $this->Calculation->avarageTaxRate($dashboardData['country']->id); // Average Tax Rate of the country, max 2 decimals
        $dashboardData['taxes']['overallCollectedTaxes'] = $this->Calculation->overallCollectedTaxes($dashboardData['country']->id); // Sum of the collected taxes of the country

        return view('home',compact('dashboardData'));
    }
}
