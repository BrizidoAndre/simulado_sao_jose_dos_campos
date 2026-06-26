<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        $user = User::where('username', $request->username)->first();
        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user->update([
            'token' => md5($user->username),
        ]);
        return [
            'token' => $user->token,
        ];
    }

    public function logout()
    {
        $user = auth()->user();
        $user->update([
            'token' => null
        ]);
        return [
            'message' => 'Successfully logged out'
        ];
    }


}
