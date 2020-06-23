<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/users';

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
        // create validator 
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        /* 
         * perform further validation after validation is completed
         * check if a user with a role that belongs to the Bureau or Respo
         * is not created twice
         */
        $validator->after(function ($validator) use ($data) {
            // get the role
            $selectRole = Role::where('id', $data['role'])->first();

            // loop through the role that aren't unique
            foreach (Role::getMassRoles() as $massRole) {
                // if the selected role is not mass assignable, throw an error
                if ($selectRole->role != $massRole) {
                    $validator->errors()->add('erreur', 'Vous ne pouvez pas créer un nouveau ' . strtolower($selectRole->role) . '.');
                    break;
                }
            }
        });

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
