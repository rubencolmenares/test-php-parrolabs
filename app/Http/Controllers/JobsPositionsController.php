<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Companies;
use App\People;
use App\Jobs;
use App\JobsPositions;
use App\JobsHirings;

class JobsPositionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function apply(Request $request, $id_jobs)
    {
        // Validate field salary_expectation between company budget 
        $company = DB::table('jobs_positions')
        ->join('jobs', 'jobs_positions.id_jobs', '=', 'jobs.id')
        ->join('companies', 'jobs_positions.id_company', '=', 'companies.id_user')
        ->select('jobs_positions.*', 'jobs.*', 'companies.budget')
        ->where('jobs_positions.id_jobs', "=", $id_jobs)
        ->first();

        $budget = $company->budget;
        $people = People::where('id_user', Auth::user()->id)->first();
        $salaryExpectation= $people->salary_expectation;
        
        if ($salaryExpectation > $budget) {
            return redirect()->back()->with('error_salary_budget', 'Your salary expectation exceeds the company budget.');
        }else{
        // Validate if the user apply for a job
        $existingHiring = JobsHirings::where('id_user', Auth::user()->id)
        ->exists();

            if ($existingHiring) {
                return redirect()->back()->with('error_existing_hiring', 'You have already applied.');
            }else{
                // Insert recor on jobs_hiring table
                JobsHirings::create([
                    'id_user' => Auth::user()->id,
                    'id_jobs_positions' => $id_jobs,
                    'hired' => false,
                ]);

                return redirect()->back()->with('success_job', 'You have successfully applied for this job.');
            }

        }
    }
    
    public function index()
    {
        $jobPositions = DB::table('jobs_positions')
        ->join('jobs', 'jobs_positions.id_jobs', '=', 'jobs.id')
        ->join('companies', 'jobs_positions.id_company', '=', 'companies.id_user')
        ->join('users', 'jobs_positions.id_company', '=', 'users.id')
        ->select('jobs_positions.*', 'jobs.*', 'companies.*', 'users.*')
        ->paginate(10);

        
        return view('jobpositions', compact('jobPositions'));
    }
}
