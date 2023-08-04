<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Bulletin::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'nullable',
            'category' => 'required|integer',
            'post_a_id' => 'required|integer|exists:admins,a_id',
            'links' => 'nullable',
        ]);
        Bulletin::create($data);
        return response()->json(['message' => 'OK']);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Bulletin::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'nullable',
            'category' => 'required|integer',
            'post_a_id' => 'required|integer|exists:admins,a_id',
            'links' => 'nullable',
        ]);
        Bulletin::find($id)->update($data);
        return response()->json(['message' => 'OK']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Bulletin::destroy($id);
        return response()->json(['message' => 'OK']);
    }
}
