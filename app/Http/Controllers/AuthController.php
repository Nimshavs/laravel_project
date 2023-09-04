<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        return view('admin');
    }

    public function studentRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Registration successful'], 200);
    }
}
