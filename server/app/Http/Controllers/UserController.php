<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'school_id' => 'required|string|unique:users',
            'name' => 'required|string',
            'birthday' => 'required|date',
            'email' => 'required|string|unique:users',
            'phone' => 'required|string|unique:users',
        ]);
        $user = User::create($data);
        return response()->json(['message' => 'OK'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'school_id' => 'required|string|exist:users',
            'name' => 'required|string',
            'birthday' => 'required|date',
            'email' => 'required|string',
            'phone' => 'required|string',
        ]);
        $user = User::find($id);
        $user->update($data);
        return response()->json(['message' => 'OK'], 200);
    }

    // update user status if users.generated is false
    public function updateStatus(Request $request, int $id)
    {
        $data = $request->validate([
            'status' => 'required',
        ]);
        $user = User::find($id);
        if ($user->generated) {
            return response()->json(['message' => 'already_generated'], 200);
        }
        $user->update($data);
        return response()->json(['message' => 'OK'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'OK'], 200);
    }
}
