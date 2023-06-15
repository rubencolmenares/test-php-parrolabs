@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>{{ __('List of Companies') }}</h1></div>
                <div class="card-body">
                <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Zip Code</th>
                                <th>Total Positions Available</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->address }}</td>
                                <td>{{ $company->zip_code }}</td>
                                <td>{{ $company->total_positions }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $companies->links() }} <!-- Agregar paginación -->
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
