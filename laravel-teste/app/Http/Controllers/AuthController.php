<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login()
    {
        if(!auth()->guest()){
            return redirect()->route('todo.index');
        }
        return view('auth.login');
    }

    public function logon(Request $request)
    {
        $request->validate([
            'username' => ['required',],
            'password' => ['required',],
        ]);
        $user = User::where('username', $request->input('username'))->first();
        if (!$user || !\Hash::check($request->input('password'), $user->password)) {
            return redirect()->route('login')->with('message', 'Invalid credentials');
        }
        auth()->login($user);
        return redirect()->route('todo.index');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'username' => ['required',],
            'password' => ['required',],
        ]);
        User::create([
            ...$data,
        ]);
        return redirect()->route('login');
    }
}
