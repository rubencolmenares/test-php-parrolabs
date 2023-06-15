<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\People;
use App\Companies;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //User validate
        $userValidator = Validator::make($data, [
            'name' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
            'rol_user_id' => ['required', 'numeric', 'max:20'],
        ]);

        if ($userValidator->fails()) {
            throw new ValidationException($userValidator);
        }

        $rolValidator = $data['rol_user_id'];

        switch ($rolValidator) {
            case '2':
                //People validate
                $peopleValidator = Validator::make($data, [
                    'age' => ['required', 'numeric', 'digits_between:0,3', 'max:100'],
                    'education_level' => ['required', 'string', 'max:12'],
                    'salary_expectation' => ['required', 'numeric', 'max:100000000'],
                ]);

                if ($peopleValidator->fails()) {
                    throw new ValidationException($peopleValidator);
                }
                break;

            case '3':
                // Company validate
                $companyValidator = Validator::make($data, [
                    'address' => ['required', 'string',  'max:255'],
                    'zip_code' => ['required', 'numeric', 'max:1000000'],
                    'budget' => ['required', 'numeric', 'max:100000000000'],
                ]);

                if ($companyValidator->fails()) {
                    throw new ValidationException($companyValidator);
                }
                break;

            default:
                throw new \InvalidArgumentException("Invalid rol_user_id");
                break;
        }
        return $userValidator; 
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol_user_id' => $data['rol_user_id'],
        ]);

        $rol = $user->rol_user_id;
        $id_user = $user->id;
        
        switch ($rol) {
            case '2':
                // People user
                $people = People::create([
                    'id_user' => $id_user,
                    'age' => $data['age'],
                    'education_level' => $data['education_level'],
                    'salary_expectation' => $data['salary_expectation'],
                ]);

                break;
            
            case '3':
                // Company user             
                $company = Companies::create([
                    'id_user' => $id_user,
                    'address' => $data['address'],
                    'zip_code' => $data['zip_code'],
                    //'total_positions' => '0',
                    'budget' => $data['budget'],
                ]);

                break;
        }
        return $user;
    }
}
