<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin',['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Admin::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'account' => 'required|string|unique:admins',
            'club_code' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|integer',
        ]);

        $admin = Admin::create($data);

        return response()->json(['message' => 'OK'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Admin::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'account' => 'required|string',
            'club_code' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|integer',
        ]);
        $admin = Admin::find($id);
        $admin->update($data);
        return response()->json(['message' => 'OK'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return response()->json(['message' => 'OK'], 200);
    }
}
