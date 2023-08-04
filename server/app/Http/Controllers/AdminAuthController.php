<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    // middleware
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }

    // login with jwt token
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'account' => 'required|string',
            'password' => 'required|string',
        ]);
        $token = auth('admin')->attempt($credentials);
        if(!$token)
        {
            return response()->json(['message' => '帳號或密碼錯誤'], 200);
        }

        $user = Admin::find(auth('admin')->user()->a_id);
        //force to update user model cache 
        auth('admin')->setUser($user);
        // Return the token along with the user info
        return response()->json(['message' => 'OK', 'user' => auth('admin')->user(), 'token' => $token], 200);
    }
    // logout
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'OK'], 200);
    }
}
