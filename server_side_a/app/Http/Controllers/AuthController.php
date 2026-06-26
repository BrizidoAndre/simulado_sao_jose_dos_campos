<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //the controller responsible for auth methods


    // renders the login page
    // is only accessible by typing in url "admin-panel"
    public function login()
    {
        if (!auth()->guest()) {
            return redirect()->route('admin.index');
        }
        return view('auth.login');
    }

    //  logs the user if username and password are correct
    public function logon(Request $request)
    {
        $request->validate([
            'username' => ['required',],
            'password' => ['required']
        ]);
        $user = User::where('username', $request->input('username'))->first();
        if (!$user || !\Hash::check($request->input('password'), $user->password)) {
            return back()->with('message', 'Invalid credentials');
        }
        auth()->login($user);
        return redirect()->route('admin.index');
    }

    // end the log user session
    public function logout()
    {
        auth()->logout();
        return redirect()->route('public.index');
    }
}
