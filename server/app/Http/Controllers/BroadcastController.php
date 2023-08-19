<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Broadcast::orderBy('broadcast_id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        $data['expired_at'] = now()->addSeconds(10);
        Broadcast::create($data);
        return response()->json(['message' => 'OK']);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Broadcast::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        $data['expired_at'] = now()->addSeconds(10)->toDateTimeString();
        Broadcast::find($id)->update($data);
        return response()->json(['message' => 'OK']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Broadcast::destroy($id);
        return response()->json(['message' => 'OK']);
    }
}
