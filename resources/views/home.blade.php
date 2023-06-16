@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <h5>{{ __('Hi') }} {{ Auth::user()->name }}</h5>
                    <br>
                    <p>{{ __('Welcome to NGO Employment service') }}</p>
                    <br>
                    <p>{{ __('You can do the following actions in our application: ') }}</p>
                    @if(auth()->user()->rol_user_id === 1)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a class="nav-link" href="{{ route('companies.index') }}">List of Companies</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->rol_user_id === 2)
                    <ul class="nav nav-pills">
                        <li class="list-group-item">
                            <a class="nav-link" href="{{ route('jobpositions.index') }}">Apply for a Job</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->rol_user_id === 3)
                    <ul class="nav nav-pills">
                        <li class="list-group-item">
                            <a class="nav-link" href="{{ route('jobs.index') }}">Create a Job</a>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
