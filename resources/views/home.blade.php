@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>{{ $dashboardData['country']->name }}</h1>           
                </div>
  
                <p> Average Tax Rate of the country :  {{ $dashboardData['taxes']['avarageTaxRate'] }}</p>
                <p> The Overall Collected Taxes of the country :  {{ $dashboardData['taxes']['overallCollectedTaxes'] }}</p>
                <p>
                    <h3> Overall amount of taxes collected per state</h3>
                    <table>
                        <thead>
                            <td> State </td>
                            <td> Collected Taxes</td>
                        </thead>
                        @foreach($dashboardData['taxes']['taxesCollectedPerState'] as $stateTaxes)
                        <tr>
                            <td>
                                {{$stateTaxes['name']}}
                            </td>
                            <td>
                                {{$stateTaxes['taxes_collected']}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </p>
                <p>
                    <h3> Average amount of taxes collected per state</h3>
                    <table>
                        <thead>
                            <td> State </td>
                            <td> AVG Collected Taxes</td>
                        </thead>
                        @foreach($dashboardData['taxes']['averageCollectedTaxPerState'] as $stateTaxes)
                        <tr>
                            <td>
                                {{$stateTaxes['name']}}
                            </td>
                            <td>
                                {{$stateTaxes['average_collected_taxes']}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </p>
                <p>
                    <h3> Average county tax rate per state</h3>
                    <table>
                        <thead>
                            <td> State </td>
                            <td> AVG Tax Rate</td>
                        </thead>
                        @foreach($dashboardData['taxes']['averageCountyTaxRatePerState'] as $stateTaxes)
                        <tr>
                            <td>
                                {{$stateTaxes['name']}}
                            </td>
                            <td>
                                {{$stateTaxes['average_tax_rate']}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </p>

            </div>
        </div>
    </div>
</div>


@endsection
