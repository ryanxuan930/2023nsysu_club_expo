<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

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
    // admin info
    public function admin()
    {
        return response()->json(['message' => 'OK', 'user' => auth('admin')->user()], 200);
    }

    // logout
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'OK'], 200);
    }

    // qrcode
    public function decode(Request $request) {
        $credentials = $request->validate([
            'club_code' => 'required|string',
            'payload' => 'required|string',
        ]);
        $payload = Crypt::decryptString($credentials['payload']);
        $user = User::where('u_id', $payload['u_id'])->where('school_id', $payload['school_id'])->first();
        if(!$user) {
            return response()->json(['message' => 'not_found'], 200);
        }
        
    }
}
