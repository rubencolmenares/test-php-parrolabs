@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Job Offers') }}</h5>
                    @if (session('error_salary_budget'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error_salary_budget') }}
                        </div>
                    @endif
                    @if (session('error_existing_hiring'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error_existing_hiring') }}
                        </div>
                    @endif
                    @if (session('success_job'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success_job') }}
                        </div>
                    @endif
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Job Role</th>
                            <th>Years of Experience Required</th>
                            <th>Position Budget</th>
                            <th>Available Job</th>
                            <th>Join</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobPositions as $jobPosition)
                        <tr>
                            <td>{{ $jobPosition->name }}</td>
                            <td>{{ $jobPosition->rol }}</td>
                            <td>{{ $jobPosition->years_exp_required }}</td>
                            <td>{{ $jobPosition->salary }}</td>
                            @if($jobPosition->available_positions == 1)
                            <td>Yes</td>
                            @else
                            <td>No</td>
                            @endif
                            <td>
                                <form action="{{ route('jobpositions.apply', $jobPosition->id_jobs) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer">
                    {{ $jobPositions->links() }} <!-- Agregar paginación -->
                </div>  
            </div>          
        </div>
    </div>
</div>
@endsection
