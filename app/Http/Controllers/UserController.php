<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register() {

        return view('users.register');

    }//end of register

    public function doRegister(Request $request) {

        $request_data = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $request_data['password'] = bcrypt($request_data['password']);

        // Create User
        $user = User::create($request_data);

        // Login
        auth()->login($user);

        return redirect(route('jobs.index'))->with('message', 'User created and logged in');


    }//end of do register

    public function login() {

        return view('users.login');

    }

    public function doLogin(Request $request) {

        $request_data = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($request_data)) {
            $request->session()->regenerate();

            return redirect(route('jobs.index'))->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }// end of do login





    public function logout() {

        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect(route('jobs.index'))->with('message', 'user logged out!');


    }//end of logout
}
