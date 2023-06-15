<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Companies;
use App\Jobs;
use App\JobsPositions;
use App\JobsHirings;

class CompaniesController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $companies = Companies::join('users', 'companies.id_user', '=', 'users.id')
        ->select('companies.*', 'users.*')
        ->paginate(10);
    
        return view('companies', compact('companies'));
    }
}
