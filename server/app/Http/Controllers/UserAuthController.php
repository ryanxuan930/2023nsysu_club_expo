<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Club;
use App\Models\Broadcast;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

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
        $clubs = Club::select('club_code')->get();
        $root = sqrt(count($clubs));
        if ($root == floor($root)) {
            $root = floor($root);
        } else {
            $root = floor($root) + 1;
        }
        // if count($clubs) less then $root * $root, fill the rest with null
        $clubs = $clubs->toArray();
        // change each element to an object with key 'club_code', 'checked' and value is its original value and false respectively
        $clubs = array_map(function($club) {
            return ['club_code' => $club['club_code'], 'checked' => false];
        }, $clubs);
        $clubs = array_pad($clubs, $root * $root, null);
        // shuffle the array
        shuffle($clubs);
        // transform the array to $root * $root matrix
        $clubs = array_chunk($clubs, $root);
        // temp is a dict variable, consist of 'matrix': $clubs, 'lines': number, 'remarks': array
        $temp = [
            'matrix' => $clubs,
            'lines' => 0,
            'remarks' => [],
        ];
        $data['status'] = $temp;
        $user = User::create($data);
        return response()->json(['message' => 'OK'], 200);
    }

    public function user()
    {
        return response()->json(['message' => 'OK', 'user' => auth('user')->user()], 200);
    }

    public function status()
    {
        // find Broadcast expired_at is greater than now
        $broadcast = Broadcast::where('expired_at', '>=', now())->first();
        $data = [
            'status' => auth('user')->user()->status,
            'broadcast' => $broadcast,
        ];
        return response()->json($data);
    }

    public function qrcode()
    {
        $user = auth('user')->user();
        $timestamp = time();
        $timestamp += 122;
        $timestamp = strval($timestamp);
        $content = [
            'u_id' => $user->u_id,
            'school_id' => $user->school_id,
            'timestamp' => $timestamp,
        ];
        $encryptedValue = Crypt::encryptString(json_encode($content));
        return response()->json($encryptedValue);
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
