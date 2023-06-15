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

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request){

        $totalPositionBudget = JobsPositions::where('id_company', Auth::user()->id)->sum('position_budget');
        $companyBudget = Companies::where('id_user', Auth::user()->id)->first()->budget;

        if ($totalPositionBudget > $companyBudget) {
            return redirect()->back()->with('job_position_error', 'The job position exceeds the company budget.');
        } else {
            //jobs validate
            $createJobsValidator = Validator::make($request->all(), [
                'rol' => ['required', 'string', 'max:1000'],
                'years_exp_required' => ['required', 'numeric', 'digits_between:0,3', 'max:100'] ,
                'salary' => ['required', 'numeric', 'max:100000000'],
            ]);

            if ($createJobsValidator->fails()) {
                        throw new ValidationException($createJobsValidator);
                }

            //Jobs Table
            $jobs = Jobs::create([
                'rol' => $request['rol'],
                'years_exp_required' => $request['years_exp_required'],
                'salary' => $request['salary'],
            ]);

            $id_job = $jobs->id;
            $job_salary = $jobs->salary;
            //Jobs_positions Table
            $jobs_positions = JobsPositions::create([
                'id_company' => Auth::user()->id,
                'id_jobs' => $jobs->id,
                'position_budget' => $jobs->salary,
                'available_positions' => '1',
            ]);

            // Increment the total_positions field in the companies table
            DB::beginTransaction();

            try {
                $company = Companies::where('id_user', Auth::user()->id)->lockForUpdate()->first();
            
                    if($company) {
                        $company->total_positions += 1;
                        $company->save();
                    }  
                    DB::commit();
                    
                } catch (\Exception $e) {
                    DB::rollBack();
                }

            return redirect()->back()->with('success', 'The job has been created successfully.');
        }
    }

    public function index()
    {
        $totalPositions = Companies::where('id_user', Auth::user()->id)->first()->total_positions;
        $jobPositions = DB::table('jobs_positions')
        ->join('jobs', 'jobs_positions.id_jobs', '=', 'jobs.id')
        ->select('jobs_positions.*', 'jobs.*')
        ->paginate(10);

        $hiringPositions = DB::table('jobs_hirings')
        ->join('jobs_positions', 'jobs_hirings.id_jobs_positions', '=', 'jobs_positions.id')
        ->join('jobs', 'jobs_positions.id_jobs', '=', 'jobs.id')
        ->join('companies', 'jobs_positions.id_company', '=', 'companies.id_user')
        ->join('users', 'jobs_hirings.id_user', '=', 'users.id')
        ->select('jobs_positions.*', 'jobs.*', 'companies.*', 'users.*')
        ->where('companies.id', Auth::user()->id)
        ->paginate(10);
        
        return view('jobs', compact('jobPositions', 'totalPositions', 'hiringPositions'));
    }
}
