<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    // middleware
    public function __construct()
    {
        $this->middleware('auth:user', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|exists:users,email',
            'school_id' => 'required|string|exists:users,school_id',
            'birthday' => 'required|date',
        ]);
    
        if ($validator->fails()) {
            if ($validator->errors()->has('email') || $validator->errors()->has('school_id')) {
                return response()->json(['message' => 'not_found'], 200);
            } else {
                return response()->json(['message' => $validator->errors()], 200);
            }
        }
        $credentials = $validator->validated();
        $user = User::where('email', $credentials['email'])
                ->where('school_id', $credentials['school_id'])
                ->where('birthday', $credentials['birthday'])
                ->first();
        if(!$user) {
            return response()->json(['message' => 'wrong_credentials'], 400);
        }
        $token = auth('user')->fromUser($user);
        auth('user')->setUser($user);
        return response()->json(['message' => 'OK', 'user' => auth('user')->user(), 'token' => $token], 200);
    }

    public function register()
    {
        $data = request()->validate([
            'school_id' => 'required|string|unique:users,school_id',
            'name' => 'required|string',
            'birthday' => 'required|date',
            'email' => 'required|string|unique:users,email',
            'phone' => 'nullable|string',
        ]);
        $user = User::create($data);
        return response()->json(['message' => 'OK'], 200);
    }

    public function user()
    {
        return response()->json(['message' => 'OK', 'user' => auth('user')->user()], 200);
    }

    public function exists()
    {
        // find user by email and school_id
        $user = User::where('email', request()->email)->where('school_id', request()->school_id)->first();
        if($user)
        {
            return response()->json(['message' => 'exist'], 200);
        }
        else
        {
            return response()->json(['message' => 'not_found'], 200);
        }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'OK'], 200);
    }
}
