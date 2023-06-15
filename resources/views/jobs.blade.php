@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __(' Create jobs') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('jobs.create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Job Role') }}</label>

                            <div class="col-md-6">
                                <input id="rol" type="text" class="form-control @error('rol') is-invalid @enderror" name="rol" value="{{ old('rol') }}" required autocomplete="rol" autofocus>

                                @error('rol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="years_exp_required" class="col-md-4 col-form-label text-md-right">{{ __('Years of experience required') }}</label>

                            <div class="col-md-6">
                                <input id="years_exp_required" type="number" class="form-control @error('years_exp_required') is-invalid @enderror" name="years_exp_required" value="{{ old('years_exp_required') }}" required autocomplete="years_exp_required">

                                @error('years_exp_required')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Salary') }}</label>

                            <div class="col-md-6">
                                <input id="salary" type="number" class="form-control" name="salary" required autocomplete="salary">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id= "jobs_save_button" type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    @if(session('job_position_error'))
                        <div class="alert alert-danger">
                            {{ session('job_position_error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div> 
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Jobs') }}</h5>
                    <br>
                    Total Positions: 
                    <span class="badge badge-primary">{{ $totalPositions }}</span>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job ID</th>
                            <th>Job Role</th>
                            <th>Years of Experience Required</th>
                            <th>Position Budget</th>
                            <th>Available Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobPositions as $jobPosition)
                        <tr>
                            <td>{{ $jobPosition->id }}</td>
                            <td>{{ $jobPosition->rol }}</td>
                            <td>{{ $jobPosition->years_exp_required }}</td>
                            <td>{{ $jobPosition->position_budget }}</td>
                            @if($jobPosition->available_positions == 1)
                            <td>Yes</td>
                            @else
                            <td>No</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer">
                    {{ $jobPositions->links() }} 
                </div>  
            </div>          
        </div>
    </div>
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Hiring') }}</h5>
                    <br>
                </div>
                <table class="table">
                        <thead>
                            <tr>
                                <th>Job Position</th>
                                <th>Job Title</th>
                                <th>Company Name</th>
                                <th>User Name</th>
                                <th>Hired</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hiringPositions as $position)
                                <tr>
                                    <td>{{ $position->position_name }}</td>
                                    <td>{{ $position->job_title }}</td>
                                    <td>{{ $position->company_name }}</td>
                                    <td>{{ $position->user_name }}</td>
                                    <td>{{ $position->hired ? 'Yes' : 'No' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
                <div class="card-footer">
                    {{ $jobPositions->links() }} 
                </div>  
            </div>          
        </div>
    </div>
</div>
@endsection
