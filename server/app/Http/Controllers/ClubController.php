<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
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
        return Club::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'club_code' => 'required|string|unique:clubs',
            'club_type' => 'required|integer',
            'club_name_ch' => 'required|string',
            'club_name_en' => 'required|string',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Club::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'club_code' => 'required|string|exist:clubs',
            'club_type' => 'required|integer',
            'club_name_ch' => 'required|string',
            'club_name_en' => 'required|string',
        ]);
        $club = Club::find($id);
        $club->update($data);
        return response()->json(['message' => 'OK'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $club = Club::find($id);
        $club->delete();
        return response()->json(['message' => 'OK'], 200);   
    }
}
