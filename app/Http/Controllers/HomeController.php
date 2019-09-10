<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CalculationController;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        dd(
            $this->Calculation->overallCollectedTaxes(1),
            $this->Calculation->taxesCollectedPerState(1),
            $this->Calculation->averageCollectedTaxPerState(1),
            $this->Calculation->averageCountyTaxRatePerState(1),
            $this->Calculation->avarageTaxRate(1)
        );

        // $countries = Country::with(['states', 'states.counties', 'states.counties.taxes'])->get()->toArray();
        $countries = Country::all();
        foreach ($countries as $country) {
            foreach ($country->states as $country_state) {
                foreach ($country_state->counties as $counties) {
                    dd($counties->taxes->sum('tax_collected'),$counties);
                }
            }
        }

        // $sql = DB::query();
        // $sql->from('countries');
        // $sql->whereIn('countries.id' ,1);
        // $sql->join('states', 'states.country_id', '=', 'countries.id');
        // $sql->join('counties', 'counties.state_id', '=', 'states.id');
        // $sql->join('taxes', 'taxes.county_id', '=', 'counties.id');
        // $sql->groupBy('states.id');
        // $sql->selectRaw('MAX(states.name) AS nume_stat, SUM(taxes.tax_collected) AS taxa_per_stat');

        $taxesCollected = $sql->get();

        foreach($taxesCollected as $taxCollected){
            dd($taxCollected->nume_stat);
        }

        return view('home',compact($dashboardData));
    }
}
