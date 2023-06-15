@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    {{ __('You are logged in!') }}
                    <br>
                    @if(auth()->user()->rol_user_id === 1)
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('companies.index') }}">List of Companies</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->rol_user_id === 2)
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobpositions.index') }}">Apply for a Job</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->rol_user_id === 3)
                    <ul class="nav nav-pills">
                        <li class="nav-item">
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
